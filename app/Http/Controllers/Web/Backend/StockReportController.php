<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StockReportController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);

        $stockQuery = Stock::query();

        if ($request->filled('batch')) {
            $stockQuery->where('batch_id', $request->batch);
        }
        if ($request->filled('product')) {
            $stockQuery->where('product_id', $request->product);
        }

        if ($request->filled('available')) {
            if ($request->available == "in") {
                $stockQuery->where('available', '>', 0);
            }

            if ($request->available == "out") {
                $stockQuery->where('available', '<=', 0);

            }
        }

        if ($request->filled('life')) {
            if ($request->life == "good") {
                $stockQuery->whereDate('best_befour', '>=', Carbon::today());
            }

            if ($request->life == "expire") {
                $stockQuery->whereDate('best_befour', '<=', Carbon::today());

            }
        }

        return view('reports.stock.index', [
            'stocks' => $stockQuery->with(['product', 'batch'])->get(),
            'products' => Product::all(),
            'batches' => Batch::all(),
        ]);
    }

}
