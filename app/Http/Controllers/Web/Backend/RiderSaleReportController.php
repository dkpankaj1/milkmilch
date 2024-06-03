<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Rider;
use App\Models\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiderSaleReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $riders = Rider::with('user')->get();
        $sellQuery = Sell::query();


        if ($request->filled('date')) {
            $sellQuery = $sellQuery->where('date', $request->date);
        } else {
            $sellQuery = $sellQuery->where('date', Carbon::today());
        }


        if ($request->filled('sale_by')) {
            $sellQuery = $sellQuery->where('user_id', $request->sale_by);
        }

        $sales = $sellQuery
            ->with('items.stock')
            ->with([
                'items' => function ($query) {
                    $query->join('stocks', 'stocks.id', '=', 'sell_items.stock_id')
                        ->selectRaw('sell_items.*, stocks.volume as stock_volume');
                }
            ])
            ->get()
            ->map(function ($sale) {
                $sale->total_volume = $sale->items->sum('stock_volume');
                return $sale;
            });

        return view('reports.riders-sale.index', ['sells' => $sales, 'riders' => $riders]);
    }
}
