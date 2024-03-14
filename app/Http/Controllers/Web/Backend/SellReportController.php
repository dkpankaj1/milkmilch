<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enums\PaymentStatusEnums;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sell;
use Illuminate\Http\Request;

class SellReportController extends Controller
{
    public function index(Request $request)
    {

        $paymentStatusEnums = [PaymentStatusEnums::PAID,PaymentStatusEnums::PARTIAL,PaymentStatusEnums::PENDING,PaymentStatusEnums::GENERATED];
        $customers = Customer::with('user')->get();
        $salesQuery = Sell::query();

        if ($request->filled('customer')) {
            $salesQuery->where('customer_id', $request->customer);
        }
        if ($request->filled('payment_status')) {
            $salesQuery->where('payment_status', '=', $request->payment_status);
        }
        // Filter sales based on date range if from_date and to_date are not null
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $salesQuery->whereBetween('date', [$request->from_date, $request->to_date]);
        } elseif ($request->filled('from_date')) { // Filter sales based on from_date if from_date is not null
            $salesQuery->where('date', '>=', $request->from_date);
        } elseif ($request->filled('to_date')) { // Filter sales based on to_date if to_date is not null
            $salesQuery->where('date', '<=', $request->to_date);
        }

        return view('reports.sell-report.index',['sells' => $salesQuery->get(),'customers' =>$customers,'selected_customer'  => $request->customer,'paymentStatusEnums' =>$paymentStatusEnums]);
    }
}
