<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;

use App\Models\Batch;
use App\Models\MilkStorage;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::latest()->paginate();
        return view('backend.batches.index', ['batches' => $batches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $storages = MilkStorage::where('status', 'storage')->where('avl_volume', '>', 0)->latest()->get();
        return view('backend.batches.create', ['storages' => $storages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'storage' => ['required', 'exists:milk_storages,id'],
            'volume' => ['required', 'numeric'],
            'date' => ['required'],
            'product' => ['required', 'array'],
        ]);

        $batch = Batch::create([
            'batch_code' => time(),
            'milk_storage_id' => $request->storage,
            'date' => $request->date,
            'volume' => $request->volume,
        ]);

        try {

            $product = $request->product;
            $productID = $product['id'];
            $shelfLife = $product['shelf_life'];
            $volume = $product['volume'];
            $mrp = $product['mrp'];
            $quentity = $product['quentity'];

            $stacks = [];

            foreach ($productID as $index => $name) {
                $stack['batch_id'] = $batch->id;
                $stack['product_id'] = $productID[$index];
                $stack['shelf_life'] = $shelfLife[$index];
                $stack['volume'] = $volume[$index];
                $stack['mrp'] = $mrp[$index];
                $stack['quentity'] = $quentity[$index];
                $stack['available'] = $quentity[$index];
                $stack['best_befour'] = Carbon::parse($request->date)->addDays($shelfLife[$index]);
                ;

                $stacks[] = $stack;
            }

            Stock::insert($stacks);


            $milkstorage = MilkStorage::where('id', $request->storage)->first();
            $milkstorage->update(['avl_volume' => $milkstorage->avl_volume - $request->volume]);


            toastr()->success(trans('crud.create', ['model' => 'batch']));

            return redirect()->back();

        } catch (\Exception $e) {

            toastr()->error($e->getMessage());

            return redirect()->back();

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
    public function edit(Batch $batch)
    {
        $storages = MilkStorage::where('status', 'storage')->latest()->get();
        return view('backend.batches.edit', ['storages' => $storages, 'batch' => $batch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch $batch)
    {
        $request->validate([
            'storage' => ['required', 'exists:milk_storages,id'],
            'volume' => ['required', 'numeric'],
            'date' => ['required'],
            'product' => ['required', 'array'],
        ]);

        try {
           
            DB::transaction(function () use ($request, $batch) {

                // restore milk storage
                $batch->milk_storage->update(['avl_volume' => (intval($batch->milk_storage->avl_volume) + intval($batch->volume ))]);

                // Update the batch
                $batch->update([
                    'milk_storage_id' => $request->storage,
                    'date' => $request->date,
                    'volume' => $request->volume,
                ]);
    
                // Delete existing stocks associated with the batch
                $batch->stocks()->delete();

                $product = $request->product;
                $productID = $product['id'];
                $shelfLife = $product['shelf_life'];
                $volume = $product['volume'];
                $mrp = $product['mrp'];
                $quentity = $product['quentity'];
    
                // Create and insert new stocks
                $stacks = [];
                foreach ($productID as $index => $name) {
                    $stack['batch_id'] = $batch->id;
                    $stack['product_id'] = $productID[$index];
                    $stack['shelf_life'] = $shelfLife[$index];
                    $stack['volume'] = $volume[$index];
                    $stack['mrp'] = $mrp[$index];
                    $stack['quentity'] = $quentity[$index];
                    $stack['available'] = $quentity[$index];
                    $stack['best_befour'] = Carbon::parse($request->date)->addDays($shelfLife[$index]);
                    ;
    
                    $stacks[] = $stack;
                }

                Stock::insert($stacks);
    
                // Update milk storage volume
                $milkstorage = MilkStorage::findOrFail($request->storage);
                $milkstorage->update(['avl_volume' => $milkstorage->avl_volume - $request->volume]);
    
            });
                       
            toastr()->success(trans('crud.update', ['model' => 'batch']));

            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function delete(Batch $batch)
    {
        // Return the view with user data
        return view('backend.batches.delete', ['batch' => $batch]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch)
    {

        try {
           
            // restore milk storage
            $batch->milk_storage->update(['avl_volume' => (intval($batch->milk_storage->avl_volume) + intval($batch->volume ))]);

            // Delete existing stocks associated with the batch
            $batch->stocks()->delete();
            $batch->delete();
                       
            toastr()->success(trans('crud.delete', ['model' => 'batch']));

            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function search_product(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')->get();
        return view('backend.batches.product_search_list', ['products' => $products]);
    }
    public function add_product(Request $request)
    {
        $product = Product::find($request->product_id);
        return view('backend.batches.add_product', ['product' => $product]);
    }
}
