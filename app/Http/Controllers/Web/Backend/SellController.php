<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enums\PaymentStatusEnums;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Rider;
use App\Models\Sell;
use App\Models\SellItems;
use App\Models\Stock;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $customers = Customer::with(['user:id,name,phone'])->select('id', 'user_id')->get();
        $riders = Rider::with(['user:id,name'])->select('id', 'user_id')->get();
        $limitInput = $request->query('limit', 20);
        $dateInput = $request->query('date', '');
        $customerInput = $request->query('customer', '');
        $paymentInput = $request->query('payment', '');
        $saleByInput = $request->query('sale_by', '');


        $sellQuery = Sell::query();


        if ($request->filled('payment')) {
            $sellQuery = $sellQuery->where('payment_status', $request->payment);
        }

        if ($request->filled('date')) {
            $sellQuery = $sellQuery->where('date', $request->date);
        }

        if ($request->filled('customer')) {
            $sellQuery = $sellQuery->where('customer_id', $request->customer);
        }

        if ($request->filled('sale_by')) {
            $sellQuery = $sellQuery->where('user_id', $request->sale_by);
        }


        if (auth()->user()->hasRole('admin')) {
            $sells = $sellQuery->latest()->with('customer')->paginate($limitInput)->withQueryString();
        } else {
            $sells = $sellQuery->latest()->with('customer')->where('user_id', auth()->user()->id)->paginate($limitInput)->withQueryString();
        }

        return view('backend.sell.index', [
            'sells' => $sells, 
            'customers' => $customers, 
            'riders' => $riders,
            'date' => $dateInput,
            'limitInput' =>$limitInput,
            'paymentInput' => $paymentInput,
            'saleByInput' => $saleByInput,
            'customerInput' => $customerInput
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $customers = Customer::with('user')->get();

        $customers = Customer::whereHas('user', function ($query) {
            $query->where('status', 1);
        })->get();


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



        try {

            DB::transaction(function () use ($request) {

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
                    $stock->update(['available' => $stock->available - $quentity[$index]]);
                }

                SellItems::insert($sellItms);
            });

            toastr()->success(trans('crud.create', ['model' => 'sells']));

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

        try {

            if ($sell->payment_status === PaymentStatusEnums::PAID) {
                throw new \Exception('Already Paid.');
            }

            $customers = Customer::whereHas('user', function ($query) {
                $query->where('status', 1);
            })->get();

            return view('backend.sell.edit', ['customers' => $customers, 'sell' => $sell]);

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sell $sell)
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

        $sell->update([
            'customer_id' => $request->customer,
            'date' => $request->sell_date,
            'other_amt' => $request->other_charges ?: 0,
            'discount' => $request->discount ?: 0,
            'discount_type' => $request->discount_type,
            'order_status' => 'complete',
            'payment_status' => 'pending',
            'grand_total' => $request->grandTotalResult,
            'paid_amt' => $sell->paid_amt,
            'note' => $request->note ?: "sell notes",
            'user_id' => $request->user()->id
        ]);

        try {

            // restore old sell
            foreach ($sell->items as $item) {
                $stock = Stock::findOrFail($item->stock_id);
                $stock->update(['available' => $stock->available + $item->quentity]);
            }

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
                $stock->update(['available' => $stock->available - $quentity[$index]]);
            }
            $sell->items()->delete();// Delete existing items
            SellItems::insert($sellItms);

            toastr()->success(trans('crud.update', ['model' => 'sells - ' . $sell->id]));

            return redirect()->back();

        } catch (\Exception $e) {

            toastr()->error($e->getMessage());

            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sell $sell)
    {
        try {
            if ($sell->payment_status === PaymentStatusEnums::PAID) {
                throw new \Exception('Already Paid.');
            }
            // sell check if payment is complete or not

            // restore old sell

            foreach ($sell->items as $item) {
                $stock = Stock::findOrFail($item->stock_id);
                $stock->update(['available' => $stock->available + $item->quentity]);
            }

            // delete sell

            $sell->items()->delete();
            $sell->delete();

            toastr()->success(trans('crud.delete', ['model' => 'sells - ' . $sell->id]));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }

    }

    public function delete(Sell $sell)
    {
        return view('backend.sell.delete', ['sell' => $sell]);
    }

    public function search_stock(Request $request)
    {
        $stockQuery = Stock::query();
        $stocks = $stockQuery->where('available', '>', 0)->whereDate('best_befour', '>=', Carbon::today())->whereHas('product', function ($query) use ($request) {
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
