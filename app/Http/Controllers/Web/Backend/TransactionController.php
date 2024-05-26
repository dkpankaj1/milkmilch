<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enums\PaymentStatusEnums;
use App\Enums\TransactionStatus;
use App\Models\Customer;
use App\Models\Sell;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transactionQuery = Transaction::query();
        $customers = Customer::with(['user:id,name,phone'])->select('id', 'user_id')->get();
        $limitInput = $request->query('limit', 20);

        if ($request->filled('payment')) {
            $transactionQuery = $transactionQuery->where('status', $request->payment);
        }

        if ($request->filled('date')) {
            $transactionQuery = $transactionQuery->where('date', $request->date);
        }

        if ($request->filled('customer')) {
            $transactionQuery = $transactionQuery->where('customer_id', $request->customer);
        }

        $transactions = $transactionQuery->latest()->paginate($limitInput);
        return view('backend.transaction.index', compact('transactions','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customers = Customer::with('user')->get();
        $salesQuery = Sell::query();
        $selected_customer = $request->customer;

        // Filter sales based on customer ID and payment status if customer is not null
        if ($request->filled('customer')) {
            $salesQuery->where('payment_status', '!=', PaymentStatusEnums::PAID)
                ->where('customer_id', $request->customer);
        }
        // Filter sales based on date range if start_date and end_date are not null
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $salesQuery->whereBetween('date', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) { // Filter sales based on start_date if start_date is not null
            $salesQuery->where('date', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) { // Filter sales based on end_date if end_date is not null
            $salesQuery->where('date', '<=', $request->end_date);
        }

        // Execute sales query if any filters are applied
        if ($request->filled('customer') || $request->filled('start_date') || $request->filled('end_date')) {
            $sales = $salesQuery->get();
        } else {
            $sales = [];
        }

        return view('backend.transaction.create', compact('customers', 'selected_customer', 'sales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => ['required', Rule::exists(Customer::class, 'id')],
            'id' => ['required', 'array'],
            'discount' => ['nullable'],
            'discount_type' => ['nullable'],
            'other_charges' => ['nullable']
        ], [
            'id.required' => "* please select minimum:1 sell"
        ]);

        try {

            if (
                Transaction::where('customer_id', $request->customer_id)
                    ->where('status', TransactionStatus::GENERATED)
                    ->exists()
            ) {
                throw new \Exception("A transaction has already been generated. Please pay or delete the existing transaction to create a new one.");
            }


            DB::transaction(function () use ($request) {

                $transactionData = [
                    "unique_id" => time(),
                    "date" => Carbon::today()->format('Y-m-d'),
                    "customer_id" => $request->customer_id,
                    "amount" => Sell::whereIn('id', $request->id)
                        ->where('payment_status', "!=", PaymentStatusEnums::PAID)
                        ->selectRaw('SUM(grand_total) - SUM(paid_amt) as total_pending_amount')->value('total_pending_amount') ?? 0,
                    "discount" => $request->discount ?? 0,
                    "discount_type" => $request->discount_type ?? "none",
                    "other_amt" => $request->other_charges ?? 0,
                    "paid_amount" => 0,
                    "status" => TransactionStatus::GENERATED,
                ];


                $discountType = $request->discount_type ?? "none";
                $amount = doubleval($transactionData['amount']);
                $discount = doubleval($transactionData['discount']);
                $otherAmt = doubleval($transactionData['other_amt']);

                if ($discountType === "percentage") {
                    $transactionData['grand_total'] = ($amount + ($amount * $discount / 100)) + $otherAmt;
                } elseif ($discountType === "fixed") {
                    $transactionData['grand_total'] = $amount + $discount + $otherAmt;
                } else {
                    $transactionData['grand_total'] = $amount + $otherAmt;
                }

                $transaction = Transaction::create($transactionData);
                $transaction->sells()->sync($request->id);

                Sell::where('payment_status', PaymentStatusEnums::PENDING)->whereIn('id', $request->id)->update(
                    [
                        'payment_status' => PaymentStatusEnums::GENERATED,
                    ]
                );

            });

            toastr()->success(trans('crud.create', ['model' => 'payment']));
            return redirect()->route('admin.transaction.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('backend.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function delete(Transaction $transaction)
    {
        return view('backend.transaction.delete', ['transaction' => $transaction]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {

        try {
            // Begin a transaction
            DB::transaction(function () use ($transaction) {

                // Check if the transaction is in a deletable state
                if ($transaction->status != TransactionStatus::GENERATED) {
                    throw new \Exception("Only transactions with status 'Completed' or 'Processing' cannot be deleted.");
                }

                // Detach associated sells
                $transaction->sells()->sync([]);

                // Update the payment status of the sells
                Sell::whereIn('id', $transaction->sells->pluck('id'))->update([
                    'payment_status' => PaymentStatusEnums::PENDING,
                ]);

                // Delete the transaction
                $transaction->delete();
            });

            // Provide success feedback
            toastr()->success(trans('crud.delete', ['model' => 'transaction']));
            return redirect()->route('admin.transaction.index');
        } catch (\Exception $e) {
            // Provide error feedback
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function print(Transaction $transaction)
    {
        // return view('backend.transaction.pdf', compact('transaction'));

        return pdf::loadView('backend.transaction.pdf', ['transaction' => $transaction])->download('transaction_invoice_' . $transaction->id . '.pdf');
    }
}
