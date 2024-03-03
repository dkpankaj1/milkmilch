<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\SellCollection;
use App\Http\Resources\SellResource;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use App\Models\Customer;
use App\Models\Sell;
use App\Models\SellItems;
use App\Models\Stock;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SellController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sellQuery = Sell::query();
        
        if (auth()->user()->hasRole('admin')) {
            $sells = $sellQuery->latest()->with('customer')->get();
        } else {
            $sells = $sellQuery->latest()->with('customer')->where('user_id', auth()->user()->id)->get();
        }

        try {
            return $this->sendSuccess('sells collection', new SellCollection($sells), 200);

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer' => ['required', 'exists:customers,id'],
            'sell_date' => ['required', 'date'],
            'products' => ['required', 'array'],
            "discount" => ['nullable'],
            "discount_type" => ['required'],
            "other_charges" => ['nullable'],
            "grand_total" => ['required'],
        ]);

        $sell = Sell::create([
            'customer_id' => $request->customer,
            'date' => $request->sell_date,
            'other_amt' => $request->other_charges ?: 0,
            'discount' => $request->discount ?: 0,
            'discount_type' => $request->discount_type,
            'order_status' => 'complete',
            'payment_status' => 'pending',
            'grand_total' => $request->grand_total,
            'paid_amt' => 0,
            'note' => $request->note ?: "sell notes",
            'user_id' => $request->user()->id
        ]);

        try {

            $products = $request->products;
            $sellItms = [];

            foreach ($products as $product) {
                $selldata = [
                    'sell_id' => $sell->id,
                    'stock_id' => $product['stock_id'],
                    'quentity' => $product['quantity'],
                    'mrp' => $product['mrp'],
                    'total_amt' => $product['total_amt'],
                ];

                $sellItms[] = $selldata;

                $stock = Stock::findOrFail($product['stock_id']);

                $stock->update(['available' => $stock->available - $product['quantity']]);

            }

            SellItems::insert($sellItms);

            return $this->sendSuccess(trans('crud.create', ['model' => 'sell']), new SellResource($sell), 200);

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function searchStock(Request $request)
    {

        $stockQuery = Stock::query();
        $stocks = $stockQuery->whereDate('best_befour', '>=', Carbon::today())->whereHas('product', function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
            ->orwhere('code', 'like', '%' . $request->search . '%');
        })->get();

        return $this->sendSuccess('stock', new StockCollection($stocks));

    }
    public function getStock(Request $request)
    {
        $stock = Stock::findOrFail($request->stock);
        return $this->sendSuccess('stock', new StockResource($stock));
    }
    public function getCustomer()
    {
        $customer = Customer::latest()->whereHas('user', function ($query) {
            $query->where('status', 1);
        })->get();

        return $this->sendSuccess('customers', new CustomerCollection($customer));
    }
}
