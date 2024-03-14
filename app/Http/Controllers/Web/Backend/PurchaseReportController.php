<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enums\PaymentStatusEnums;
use App\Http\Controllers\Controller;
use App\Models\MilkPurchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    public function index(Request $request)
    {
        $milkPurchaseQuery = MilkPurchase::query();


        if ($request->filled('customer')) {
            $milkPurchaseQuery->where('supplier_id', $request->supplier_id);
        }
        if ($request->filled('payment_status')) {
            $milkPurchaseQuery->where('payment_status', '=', $request->payment_status);
        }
        // Filter sales based on date range if from_date and to_date are not null
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $milkPurchaseQuery->whereBetween('purchase_date', [$request->from_date, $request->to_date]);
        } elseif ($request->filled('from_date')) { // Filter sales based on from_date if from_date is not null
            $milkPurchaseQuery->where('purchase_date', '>=', $request->from_date);
        } elseif ($request->filled('to_date')) { // Filter sales based on to_date if to_date is not null
            $milkPurchaseQuery->where('purchase_date', '<=', $request->to_date);
        }



        return view('reports.purchase-report.index',[
            'suppliers' => Supplier::all(),
            'paymentStatusEnums' => [
                PaymentStatusEnums::PAID,
                PaymentStatusEnums::PARTIAL,
                PaymentStatusEnums::PENDING,
                PaymentStatusEnums::GENERATED
            ],
            'purchases' =>$milkPurchaseQuery->with(['supplier', 'items', 'payments'])->get(),
        ]);
    }
}
