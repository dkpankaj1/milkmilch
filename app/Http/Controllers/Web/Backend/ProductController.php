<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Spatie\Image\Image;

class ProductController extends Controller
{
    protected $imageManager;

    function __construct()
    {
        $this->imageManager = Image::useImageDriver('gd');
        ;
    }

    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('backend.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();
        return view('backend.product.create', ['categories' => $categories,'units' => $units]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
            'shelf_life' => ['required', 'numeric', 'min:0'],
            'volume' => ['required', 'numeric'],
            'mrp' => ['required', 'numeric', 'min:0'],
            'product_image' => ['sometimes', 'mimes:jpg,png'],
            'categorie_id' => ['required', 'exists:categories,id'],
            'unit_id' => ['required', 'exists:units,id'],
            'status' => ['required', 'min:0', 'max:1'],
            'description' => ['required', 'string']
        ]);

        $data = [
            'code' => strtoupper(str_replace(' ', '', $request->code)),
            'categorie_id' => $request->categorie_id,
            'unit_id' => $request->unit_id,
            'name' => $request->name,
            'shelf_life' => $request->shelf_life,
            'volume' => $request->volume,
            'mrp' => $request->mrp,
            'status' => $request->status,
            'description' => $request->description
        ];

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $data["product_image"] = $this->imageManager->loadFile($image->getRealPath())->width(200)->height(200)->base64();
        }

        try {
            Product::create($data);
            toastr()->success(trans('crud.create', ['model' => 'product']));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Categorie::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();
        return view('backend.product.edit', ['categories' => $categories, 'product' => $product,'units' => $units]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
            'shelf_life' => ['required', 'numeric', 'min:0'],
            'volume' => ['required', 'numeric'],
            'mrp' => ['required', 'numeric', 'min:0'],
            'product_image' => ['sometimes', 'mimes:jpg,png'],
            'categorie_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'min:0', 'max:1'],
            'unit_id' => ['required', 'exists:units,id'],
            'description' => ['required', 'string']
        ]);

        $data = [
            'code' => strtoupper(str_replace(' ', '', $request->code)),
            'categorie_id' => $request->categorie_id,
            'name' => $request->name,
            'shelf_life' => $request->shelf_life,
            'volume' => $request->volume,
            'mrp' => $request->mrp,
            'status' => $request->status,
            'unit_id' => $request->unit_id,
            'description' => $request->description
        ];

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $data["product_image"] = $this->imageManager->loadFile($image->getRealPath())->width(200)->height(200)->base64();
        }

        try {
            $product->update($data);
            toastr()->success(trans('crud.update', ['model' => 'product']));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function delete(Product $product)
    {
        return view('backend.product.delete', ['product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            toastr()->success(trans('crud.delete', ['model' => 'product']));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
