<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enums\PaymentStatusEnums;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::latest()->paginate();
        return view('backend.payments.index', compact('payments'));
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

        return view('backend.payments.create', compact('customers', 'selected_customer', 'sales'));
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

            DB::transaction(function () use ($request) {

                $paymentData = [
                    "customer_id" => $request->customer_id,
                    "date" => Carbon::today()->format('Y-m-d'),
                    "amount" => Sell::where('payment_status',PaymentStatusEnums::PENDING)->whereIn('id', $request->id)->sum('grand_total'),
                    "discount" => $request->discount ?? 0,
                    "discount_type" => $request->discount_type ?? "none",
                    "other_amt" => $request->other_charges ?? 0,
                    "grand_total" => $request->grandTotalResult ?? 0,
                    "paid_amount" => 0,
                    "payment_status" => PaymentStatusEnums::PENDING,
                    "user_id" => auth()->user()->id
                ];

                $payment = Payment::create($paymentData);
                Sell::where('payment_status', PaymentStatusEnums::PENDING)->whereIn('id', $request->id)->update(
                    [
                        'payment_status' => PaymentStatusEnums::GENERATED,
                        'payment_id' => $payment->id,
                    ]);

            });

            toastr()->success(trans('crud.create', ['model' => 'payment']));
            return redirect()->route('admin.payment.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
    public function downloadPaymentInvoice(Payment $payment)
    {
        // return view('backend.payments.invoice', ['payment' => $payment]);
        return pdf::loadView('backend.payments.invoice', ['payment' => $payment])->download('payment_invoice_' . $payment->id . '.pdf');
    }
}
