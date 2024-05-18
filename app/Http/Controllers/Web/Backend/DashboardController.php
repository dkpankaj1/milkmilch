<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MilkPurchase;
use App\Models\Rider;
use App\Models\Sell;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // if($request->search){
            
        // }

        $today_sale = Sell::whereDay('created_at', now()->day)->sum('grand_total');
        $total_sale = Sell::sum('grand_total') ;
        $today_purchase = MilkPurchase::whereDay('created_at', now()->day)->sum('grand_total') ;
        $total_purchase = MilkPurchase::sum('grand_total');
        $available_stock = Stock::whereDate('best_befour', '>=', Carbon::today())->sum('available');
        $in_storage = 0;
        $total_customer = Customer::count();
        $total_rider = Rider::count();

        $new_sale = Sell::latest()->take(5)->get();
        $new_purchase = MilkPurchase::latest()->take(5)->get();
        // $sale_analytic = Sell::query()->whereDate('created_at', now()->subMonth())->get();

        return view('backend.dashboard.index',[
            "today_sale" => $today_sale,
            "total_sale" => $total_sale,
            "today_purchase" => $today_purchase,
            "total_purchase" => $total_purchase,
            "available_stock" => $available_stock,
            "in_storage" => $in_storage,
            "total_customer" => $total_customer,
            "total_rider" => $total_rider,
            "new_sale" => $new_sale,
            "new_purchase" => $new_purchase,
        ]);
    }
}
