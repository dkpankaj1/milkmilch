<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Milk;
use App\Models\MilkPurchase;
use App\Models\MilkPurchaseItem;
use App\Models\Supplier;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Jackiedo\Cart\Cart;

class MilkPurchaseController extends Controller
{
    use HttpResponses;
    protected $cart;
    public function __construct()
    {
        $this->cart = new Cart();
        $this->cart->name('milk-purchase');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $milk_purchases = MilkPurchase::with(['supplier', 'items', 'payments'])->paginate();
        return view('backend.milk-purchase.index', ['milk_purchases' => $milk_purchases]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::whereHas('user', function ($query) {
            $query->where('status', 1);
        })->get();
        return view('backend.milk-purchase.create', ['suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'purchase_date' => ['required'],
            'supplier' => ['required', 'exists:suppliers,id'],
            'product' => ['required', 'array'],
            'other_charges' => ['nullable', 'numeric'],
            'grandTotalResult' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'discount_type' => ['required'],
            'status' => ['required'],
            'note' => ['nullable']
        ]);

        $data = [
            'purchase_date' => $request->purchase_date,
            'supplier_id' => $request->supplier,
            'other_amt' => $request->other_charges ?: 0,
            'grand_total' => $request->grandTotalResult,
            'discount' => $request->discount ?: 0,
            'discount_type' => $request->discount_type,
            'order_status' => $request->status,
            'payment_status' => 'pending',
            'note' => $request->note ?: "purchase note"
        ];

        $productList = [];

        try {

            $milk_purchase_id = MilkPurchase::create($data)->id;


            $product = $request->product;
            $productID = $product['id'];
            $fatContent = $product['fat_content'];
            $shelfLife = $product['shelf_life'];
            $volume = $product['volume'];
            $mrp = $product['mrp'];
            $mop = $product['mop'];
            $total_amt = $product['total_amt'];

            foreach ($productID as $index => $name) {
                $productData['milk_purchase_id'] = $milk_purchase_id;
                $productData['milk_id'] = $productID[$index];
                $productData['fat_content'] = $fatContent[$index];
                $productData['shelf_life'] = $shelfLife[$index];
                $productData['volume'] = $volume[$index];
                $productData['mrp'] = $mrp[$index];
                $productData['mop'] = $mop[$index];
                $productData['total_amt'] = $total_amt[$index];

                $productList[] = $productData;
            }
            
            MilkPurchaseItem::insert($productList);

            toastr()->success(trans('crud.create', ['model' => 'milk purchase']));
            
            return redirect()->back();

        } catch (\Exception $e) {

            toastr()->error($e->getMessage());

            return redirect()->back();

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(MilkPurchase $milkPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MilkPurchase $milkPurchase)
    {
        $suppliers = Supplier::whereHas('user', function ($query) {
            $query->where('status', 1);
        })->get();
        return view('backend.milk-purchase.edit', ['milkPurchase' => $milkPurchase, 'suppliers' => $suppliers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MilkPurchase $milkPurchase)
    {
        $request->validate([
            'purchase_date' => ['required'],
            'supplier' => ['required', 'exists:suppliers,id'],
            'product' => ['required', 'array'],
            'other_charges' => ['nullable', 'numeric'],
            'grandTotalResult' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'discount_type' => ['required'],
            'status' => ['required'],
            'note' => ['nullable']
        ]);
    
        $data = [
            'purchase_date' => $request->purchase_date,
            'supplier_id' => $request->supplier,
            'other_amt' => $request->other_charges ?: 0,
            'grand_total' => $request->grandTotalResult,
            'discount' => $request->discount ?: 0,
            'discount_type' => $request->discount_type,
            'order_status' => $request->status,
            'payment_status' => 'pending',
            'note' => $request->note ?: "purchase note"
        ];
    
        $productList = [];
    
        try {
    
            $milk_purchase = $milkPurchase;
            $milk_purchase->update($data);
    
            $product = $request->product;
            $productID = $product['id'];
            $fatContent = $product['fat_content'];
            $shelfLife = $product['shelf_life'];
            $volume = $product['volume'];
            $mrp = $product['mrp'];
            $mop = $product['mop'];
            $total_amt = $product['total_amt'];
    
            foreach ($productID as $index => $name) {
                $productData['milk_purchase_id'] = $milk_purchase->id;
                $productData['milk_id'] = $productID[$index];
                $productData['fat_content'] = $fatContent[$index];
                $productData['shelf_life'] = $shelfLife[$index];
                $productData['volume'] = $volume[$index];
                $productData['mrp'] = $mrp[$index];
                $productData['mop'] = $mop[$index];
                $productData['total_amt'] = $total_amt[$index];
    
                $productList[] = $productData;
            }
    
            $milk_purchase->items()->delete(); // Delete existing items
            MilkPurchaseItem::insert($productList);
    
            toastr()->success(trans('crud.update', ['model' => 'milk purchase']));
    
            return redirect()->back();
    
        } catch (\Exception $e) {
    
            toastr()->error($e->getMessage());
    
            return redirect()->back();
    
        }
    }

    public function delete(MilkPurchase $milkPurchase)
    {
        return view('backend.milk-purchase.delete', ['milkPurchase' => $milkPurchase]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MilkPurchase $milkPurchase)
    {
        try {
            $milkPurchase->items()->delete();
            $milkPurchase->delete();
            toastr()->success(trans('crud.delete', ['model' => 'MP-'.$milkPurchase->id]));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function search_milk_product(Request $request)
    {
        $milks = Milk::where('name', 'like', '%' . $request->search . '%')->get();
        return view('backend.milk-purchase.search_item_list', ['milks' => $milks]);
    }

    public function get_milk_product(Request $request)
    {
        $milk = Milk::find($request->id);
        return view('backend.milk-purchase.milk-item', ['milk' => $milk]);
    }
}
