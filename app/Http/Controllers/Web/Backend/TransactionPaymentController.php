<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enums\PaymentStatusEnums;
use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionPaymentController extends Controller
{
    public function index(Request $request)
    {
        $transactionPayments = TransactionPayment::with('transaction')->paginate();
        $customers = Customer::with('user')->get();
        return view('backend.transaction.payment.index', compact('transactionPayments', 'customers'));
    }

    public function create(Transaction $transaction)
    {
        try {
            // Check if the transaction is in a deletable state
            if ($transaction->status == TransactionStatus::COMPLETED) {
                throw new \Exception("Only transactions with status 'Completed' or 'Processing' cannot be deleted.");
            }
            return view('backend.transaction.payment.create', compact('transaction'));
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }

    }

    public function store(Request $request, Transaction $transaction)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'use_wallet' => ['nullable', 'boolean'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'method' => ['required', 'string', 'in:online,cash'],
        ], [
            'use_wallet.boolean' => 'The use wallet field must be true or false.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 0.01.',
            'method.required' => 'The payment method is required.',
            'method.string' => 'The payment method must be a valid string.',
            'method.in' => 'The selected payment method is invalid. It must be one of the following: credit card, PayPal, or bank transfer.',
        ]);

        try {
            if ($transaction->status == TransactionStatus::COMPLETED) {
                throw new \Exception('Already Paid.');
            }

            //  check request amt is not zero
            if (doubleval($request->amount) <= 0) {
                throw new \Exception('Pay amount is not zero');
            }

            DB::transaction(function () use ($request, $transaction) {
                // store request amt
                $remainAmount = doubleval($request->amount);
                $paidAmount = $remainAmount;

                // use want to use wallet the add wallet amt ro request amt and update wallet to zero
                if ($request->has('use_wallet')) {
                    $remainAmount = $remainAmount + doubleval($transaction->customer->wallet);
                }

                // retrieve  sales related  to payment
                $sales = $transaction->sells;
                foreach ($sales as $sale) {

                    if ($sale->payment_status != PaymentStatusEnums::PAID) {

                        if (doubleval($sale->grand_total) <= $remainAmount) {

                            $remainAmount = $remainAmount - doubleval($sale->grand_total);

                            $sale->update([
                                'paid_amt' => $sale->grand_total,
                                'payment_status' => PaymentStatusEnums::PAID,
                            ]);

                        } else {
                            $sale->update([
                                'payment_status' => PaymentStatusEnums::PENDING,
                            ]);
                        }
                    }

                }

                // update payment
                $transaction->update([
                    "paid_amount" => $request->amount,
                    "status" => TransactionStatus::COMPLETED,
                ]);

                if ($request->has('use_wallet')) {
                    $transaction->customer->update([
                        'wallet' => $paidAmount - $remainAmount
                    ]);
                } else {
                    $transaction->customer->update([
                        'wallet' => doubleval($transaction->customer->wallet) + $remainAmount
                    ]);
                }

                TransactionPayment::create([
                    "transaction_id" => $transaction->id,
                    "date" => $request->date,
                    "amount" => $request->amount,
                    "method" => $request->method,
                    "status" => TransactionStatus::COMPLETED,
                    "user_id" => $request->user()->id,
                    'use_wallet_amt' => $request->has('use_wallet') ? $transaction->customer->wallet : 0
                ]);

            });

            toastr()->success(trans('crud.create', ['model' => 'transaction']));
            return redirect()->route('admin.transaction-payment.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function show()
    {

    }

    public function edit(TransactionPayment $transaction_payment)
    {
        try {
            return view('backend.transaction.payment.edit', ['transaction_payment' => $transaction_payment]);
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }

    }


    public function update(Request $request, TransactionPayment $transaction_payment)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'use_wallet' => ['nullable', 'boolean'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'method' => ['required', 'string', 'in:online,cash'],
        ], [
            'use_wallet.boolean' => 'The use wallet field must be true or false.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 0.01.',
            'method.required' => 'The payment method is required.',
            'method.string' => 'The payment method must be a valid string.',
            'method.in' => 'The selected payment method is invalid. It must be one of the following: online or cash.',
        ]);

        try {
            DB::transaction(function () use ($request, $transaction_payment) {
                $transaction = $transaction_payment->transaction;
                $customer = $transaction->customer;

                // Revert previous payment and update wallet
                $used_wallet_amount = $transaction_payment->use_wallet_amt;
                $total_paid_amount = $transaction_payment->amount + $used_wallet_amount;
                $paid_amount = $transaction->sells->sum('paid_amt');
                $wallet_difference = $total_paid_amount - $paid_amount;
                $customer_wallet = $customer->wallet - $wallet_difference;

                // Reset all sales payment status to pending
                foreach ($transaction->sells as $sale) {
                    if ($sale->payment_status == PaymentStatusEnums::PAID) {
                        $sale->update(['paid_amt' => 0, 'payment_status' => PaymentStatusEnums::PENDING]);
                    }
                }

                $remainAmount = $request->amount;
                if ($request->use_wallet) {
                    $remainAmount += $customer_wallet;
                }

                // Update sales payment
                foreach ($transaction->sells as $sale) {
                    if ($sale->payment_status != PaymentStatusEnums::PAID) {
                        if ($sale->grand_total <= $remainAmount) {
                            $sale->update([
                                'paid_amt' => $sale->grand_total,
                                'payment_status' => PaymentStatusEnums::PAID,
                            ]);
                            $remainAmount -= $sale->grand_total;
                        } else {
                            $sale->update(['payment_status' => PaymentStatusEnums::PENDING]);
                        }
                    }
                }

                // Update transaction and customer wallet
                $transaction->update([
                    'paid_amount' => $request->amount,
                    'status' => TransactionStatus::COMPLETED,
                ]);

                $customer->update([
                    'wallet' => $request->use_wallet ? $remainAmount : $customer_wallet + $remainAmount,
                ]);

                // Create new payment record
                TransactionPayment::create([
                    'transaction_id' => $transaction->id,
                    'date' => $request->date,
                    'amount' => $request->amount,
                    'method' => $request->method,
                    'status' => TransactionStatus::COMPLETED,
                    'user_id' => $request->user()->id,
                    'use_wallet_amt' => $request->use_wallet ? $customer_wallet : 0,
                ]);

                // Delete old payment record
                $transaction_payment->delete();
            });

            toastr()->success(trans('crud.update', ['model' => 'transaction']));
            return redirect()->route('admin.transaction-payment.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function delete()
    {

    }

    public function destroy(TransactionPayment $transaction_payment)
    {

        try {
            DB::transaction(function () use ($transaction_payment) {
                $transaction = $transaction_payment->transaction;
                $customer = $transaction->customer;

                // Revert previous payment and update wallet
                $used_wallet_amount = $transaction_payment->use_wallet_amt;
                $total_paid_amount = $transaction_payment->amount + $used_wallet_amount;
                $paid_amount = $transaction->sells->sum('paid_amt');
                $wallet_difference = $total_paid_amount - $paid_amount;
                $customer_wallet = $customer->wallet - $wallet_difference;

                // Reset all sales payment status to pending
                foreach ($transaction->sells as $sale) {
                    if ($sale->payment_status == PaymentStatusEnums::PAID) {
                        $sale->update(['paid_amt' => 0, 'payment_status' => PaymentStatusEnums::PENDING]);
                    }
                }


                // Update transaction and customer wallet
                $transaction->update([
                    'paid_amount' => doubleval($transaction->paid_amount) - doubleval($transaction_payment->amount),
                    'status' => TransactionStatus::GENERATED,
                ]);

                $customer->update([
                    'wallet' => $customer_wallet,
                ]);

                // Delete old payment record
                $transaction_payment->delete();
            });

            toastr()->success(trans('crud.delete', ['model' => 'transaction']));
            return redirect()->route('admin.transaction-payment.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }

    }

    public function print()
    {

    }
}
