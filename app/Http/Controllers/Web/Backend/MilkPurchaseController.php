<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Milk;
use App\Models\MilkPurchase;
use App\Models\MilkPurchaseItem;
use App\Models\MilkStorage;
use App\Models\Supplier;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
// use Jackiedo\Cart\Cart;
use Barryvdh\DomPDF\Facade\Pdf;

class MilkPurchaseController extends Controller
{
    use HttpResponses;
    protected $cart;
    public function __construct()
    {
        // $this->cart = new Cart();
        // $this->cart->name('milk-purchase');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $milk_purchases = MilkPurchase::latest()->with(['supplier', 'items', 'payments'])->paginate();
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

            $milk_purchase = MilkPurchase::create($data);


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


                $shelfLifeUpTo = Carbon::parse($milk_purchase->purchase_date)->addDays($shelfLife[$index]);

                if (Carbon::today()->lessThan($shelfLifeUpTo)) {

                    if ($milk_purchase->order_status == "received") {

                        $milkstorage = MilkStorage::firstOrCreate(
                            ['date' => $milk_purchase->purchase_date, 'milk_id' => $productData['milk_id']],
                            [
                                'date' => $milk_purchase->purchase_date,
                                'milk_id' => $productData['milk_id'],
                                'ttl_volume' => 0,
                                'avl_volume' => 0,
                                'avg_shelf_life' => 0,
                                'status' => 'storage'
                            ],
                        );

                        $milkstorage->ttl_volume += $productData['volume'];
                        $milkstorage->avg_shelf_life = $productData['shelf_life'];
                        $milkstorage->avl_volume += $productData['volume'];
                        $milkstorage->save();
                    }
                }
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
            $previousState = $milkPurchase->order_status;
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


                $shelfLifeUpTo = Carbon::parse($milk_purchase->purchase_date)->addDays($shelfLife[$index]);

                if (Carbon::today()->lessThan($shelfLifeUpTo)) {

                    if ($previousState != "received" && $milk_purchase->order_status == "received") {

                        $milkstorage = MilkStorage::firstOrCreate(
                            ['date' => $milk_purchase->purchase_date, 'milk_id' => $productData['milk_id']],
                            [
                                'date' => $milk_purchase->purchase_date,
                                'milk_id' => $productData['milk_id'],
                                'ttl_volume' => 0,
                                'avl_volume' => 0,
                                'avg_shelf_life' => 0,
                                'status' => 'storage'
                            ],
                        );

                        $milkstorage->ttl_volume += $productData['volume'];
                        $milkstorage->avg_shelf_life = $productData['shelf_life'];
                        $milkstorage->avl_volume += $productData['volume'];
                        $milkstorage->save();
                    }

                    if ($previousState == "received" && $milk_purchase->order_status != "received") {

                        $milkstorage = MilkStorage::firstOrCreate(
                            ['date' => $milk_purchase->purchase_date, 'milk_id' => $productData['milk_id']],
                            [
                                'date' => $milk_purchase->purchase_date,
                                'milk_id' => $productData['milk_id'],
                                'ttl_volume' => 0,
                                'avl_volume' => 0,
                                'avg_shelf_life' => 0,
                                'status' => 'storage'
                            ],
                        );

                        $milkstorage->ttl_volume -= $productData['volume'];
                        $milkstorage->avl_volume -= $productData['volume'];
                        $milkstorage->save();
                    }

                }
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
            if ($milkPurchase->order_status == "received") {

                foreach ($milkPurchase->items()->get() as $item) {

                    $milkstorage = MilkStorage::where(
                        ['date' => $milkPurchase->purchase_date, 'milk_id' => $item->milk_id],
                    )->first();

                    if ($milkstorage) {
                        $milkstorage->ttl_volume -= $item->volume;
                        $milkstorage->save();
                    }
                }
            }
            $milkPurchase->items()->delete();
            $milkPurchase->delete();
            toastr()->success(trans('crud.delete', ['model' => 'MP-' . $milkPurchase->id]));
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
    public function downloadMilkPurchaseInvoice(MilkPurchase $milkPurchase)
    {
        // return view('backend.milk-purchase.invoice', ['invoice' => $milkPurchase]);                        
        return pdf::loadView('backend.milk-purchase.invoice', ['invoice' => $milkPurchase])->download('invoice.pdf');
    }
}
