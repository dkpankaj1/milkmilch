<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sell;
use App\Models\SellItems;
use App\Models\Stock;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sellQuery = Sell::query();
        if(auth()->user()->hasRole('admin')) {
            $sells =  $sellQuery->latest()->with('customer')->get();
        } else {
            $sells =  $sellQuery->latest()->with('customer')->where('user_id', auth()->user()->id)->get();
        }

        return view('backend.sell.index', ['sells' => $sells]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::with('user')->get();
        return view('backend.sell.create', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer' => ['required', 'exists:customers,id'],
            'sell_date' => ['required', 'date'],
            'product' => ['required', 'array'],
            "discount" => ['nullable'],
            "discount_type" => ['required'],
            "other_charges" => ['nullable'],
            "grandTotalResult" => ['required'],
        ]);

        $sell = Sell::create([
            'customer_id' => $request->customer,
            'date' => $request->sell_date,
            'other_amt' => $request->other_charges ?: 0,
            'discount' => $request->discount ?: 0,
            'discount_type' => $request->discount_type,
            'order_status' => 'complete',
            'payment_status' => 'pending',
            'grand_total' => $request->grandTotalResult,
            'paid_amt' => 0,
            'note' => $request->note ?: "sell notes",
            'user_id' => $request->user()->id
        ]);

        try {

            $product = $request->product;
            $stockID = $product['id'];
            $quentity = $product['quentity'];
            $mrp = $product['mrp'];
            $totalAmt = $product['total_amt'];

            $sellItms = [];

            foreach ($stockID as $index => $value) {
                $sellItm['sell_id'] = $sell->id;
                $sellItm['stock_id'] = $stockID[$index];
                $sellItm['quentity'] = $quentity[$index];
                $sellItm['mrp'] = $mrp[$index];
                $sellItm['total_amt'] = $totalAmt[$index];

                $sellItms[] = $sellItm;

                $stock = Stock::findOrFail($stockID[$index]);
                $stock->update(['available' => $stock->available -  $quentity[$index]]);
            }

            SellItems::insert($sellItms);

            toastr()->success(trans('crud.create', ['model' => 'sels']));

            return redirect()->back();

        } catch (\Exception $e) {

            toastr()->error($e->getMessage());

            return redirect()->back();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sell $sell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sell $sell)
    {
        //
    }

    public function search_stock(Request $request)
    {
        $stockQuery = Stock::query();
        $stocks = $stockQuery->whereDate('best_befour', '>=', Carbon::today())->whereHas('product', function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })->get();

        return view('backend.sell.stock_search_list', ['stocks' => $stocks]);
    }

    public function get_stock(Request $request)
    {
        $stock = Stock::findOrFail($request->stock);
        return view('backend.sell.stock_item_list', ['stock' => $stock]);
    }
}
