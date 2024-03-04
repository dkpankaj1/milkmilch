<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enums\PaymentStatusEnums;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PaymentTransactionController extends Controller
{
    public function create(Payment $payment)
    {
        return view('backend.payments.transactions.create', compact('payment'));
    }

    public function store(Request $request, Payment $payment)
    {
        $request->validate([
            "use_wallet" => ['nullable'],
            "paid_amt" => ['required', 'min:1']
        ]);

        try {
            if($payment->payment_status == PaymentStatusEnums::PAID)
            {
                throw new \Exception('Already Paid.');
            }

            //  check request amt is not zero
            if (doubleval($request->paid_amt) <= 0) {
                throw new \Exception('Pay amount is not zero');
            }

            DB::transaction(function () use ($request, $payment) {
                // store request amt
                $remainAmount = doubleval($request->paid_amt);
                $paidAmount = $remainAmount;

                // use want to use wallet the add wallet amt ro request amt and update wallet to zero
                if ($request->has('use_wallet')) {
                    $remainAmount = $remainAmount + doubleval($payment->customer->wallet);
                }

                // retrieve  sales related  to payment
                $sales = $payment->sales;

                foreach ($sales as $sale) {

                    if (doubleval($sale->grand_total) <= $remainAmount) {

                        $remainAmount = $remainAmount - doubleval($sale->grand_total);

                        $sale->update([
                            'paid_amt' => $sale->grand_total,
                            'payment_status' => PaymentStatusEnums::PAID,
                        ]);

                    } else {
                        $sale->update([
                            'payment_status' => PaymentStatusEnums::PENDING,
                            'payment_id' => null
                        ]);
                    }
                }

                // update payment
                $payment->update([
                    "paid_amount" => $paidAmount - $remainAmount,
                    "payment_status" => PaymentStatusEnums::PAID,
                ]);

                $request->has('use_wallet')
                    ? $payment->customer->update([
                        'wallet' => $paidAmount - $remainAmount
                    ])
                    : $payment->customer->update([
                        'wallet' => doubleval($payment->customer->wallet) + doubleval($remainAmount)
                    ]);

            });

            toastr()->success(trans('crud.create', ['model' => 'transaction']));
            return redirect()->route('admin.payment.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
