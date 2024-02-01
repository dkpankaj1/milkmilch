<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use App\Models\Customer;
use App\Models\Sell;
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
        //
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

        // $request->validate([
        //     'customer' => ['required', 'exists:customers,id'],
        //     'sell_date' => ['required', 'date'],
        //     'product' => ['required', 'array'],
        //     "discount" => ['nullable'],
        //     "discount_type" => ['required'],
        //     "other_charges" => ['nullable'],
        //     "grandTotalResult" => ['required'],
        // ]);

        // $sell = Sell::create([
        //     'customer_id' => $request->customer,
        //     'date' => $request->sell_date,
        //     'other_amt' => $request->other_charges ?: 0,
        //     'discount' => $request->discount ?: 0,
        //     'discount_type' => $request->discount_type,
        //     'order_status' => 'complete',
        //     'payment_status' => 'pending',
        //     'grand_total' => $request->grandTotalResult,
        //     'paid_amt' => 0,
        //     'note' => $request->note ?: "sell notes",
        //     'user_id' => $request->user()->id
        // ]);

        // try {

        //     $product = $request->product;
        //     $stockID = $product['id'];
        //     $quentity = $product['quentity'];
        //     $mrp = $product['mrp'];
        //     $totalAmt = $product['total_amt'];

        //     $sellItms = [];

        //     foreach ($stockID as $index => $value) {
        //         $sellItm['sell_id'] = $sell->id;
        //         $sellItm['stock_id'] = $stockID[$index];
        //         $sellItm['quentity'] = $quentity[$index];
        //         $sellItm['mrp'] = $mrp[$index];
        //         $sellItm['total_amt'] = $totalAmt[$index];

        //         $sellItms[] = $sellItm;

        //         $stock = Stock::findOrFail($stockID[$index]);
        //         $stock->update(['available' => $stock->available -  $quentity[$index]]);
        //     }

        //     $sellItm::insert($sellItms);

        //     // return $this->sendSuccess(trans('crud.create', ['model' => 'sell']), new UserResource($user), 200);

        // } catch (\Exception $e) {
        //     // Return error response in case of an exception
        //     // return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        // }

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
            $query->where('name', 'like', '%' . $request->search . '%');
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
