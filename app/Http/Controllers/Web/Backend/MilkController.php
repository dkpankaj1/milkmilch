<?php
namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Milk;
use Illuminate\Http\Request;
use Spatie\Image\Image;

class MilkController extends Controller
{
    protected $imageManager;
    function __construct()
    {
        $this->imageManager = Image::useImageDriver('gd');
    }
    public function index()
    {
        $milks = Milk::all();
        return view('backend.milk.index', ['milks' => $milks]);
    }
    public function create()
    {
        return view('backend.milk.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'fat_content' => ['required', 'numeric', 'min:0', 'max:100'],
            'shelf_life' => ['required', 'numeric', 'min:0'],
            'volume' => ['required', 'numeric'],
            'mrp' => ['required', 'numeric', 'min:0'],
            'mop' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'min:0', 'max:1'],
            'description' => ['required', 'string']
        ]);

        $data = [
            'name' => $request->name,
            'fat_content' => $request->fat_content,
            'shelf_life' => $request->shelf_life,
            'volume' => $request->volume,
            'mrp' => $request->mrp,
            'mop' => $request->mop,
            'status' => $request->status,
            'description' => $request->description
        ];

        try {
            Milk::create($data);
            toastr()->success(trans('crud.create', ['model' => 'milk']));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function show(Milk $milk)
    {
        return view('backend.milk.show', ['milk' => $milk]);
    }
    public function edit(Milk $milk)
    {
        return view('backend.milk.edit', ['milk' => $milk]);
    }
    public function update(Request $request, Milk $milk)
    {
        $request->validate([
            'name' => ['sometimes'],
            'fat_content' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'shelf_life' => ['sometimes', 'numeric', 'min:0'],
            'volume' => ['sometimes', 'numeric'],
            'mrp' => ['sometimes', 'numeric', 'min:0'],
            'mop' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['required'],
            'description' => ['sometimes', 'string']
        ]);

        $data = [
            'name' => $request->name ?: $milk->name,
            'fat_content' => $request->fat_content ?: $milk->fat_content,
            'shelf_life' => $request->shelf_life ?: $milk->shelf_life,
            'volume' => $request->volume ?: $milk->volume,
            'mrp' => $request->mrp ?: $milk->mrp,
            'mop' => $request->mop ?: $milk->mop,
            'status' => $request->status,
            'description' => $request->description ?: $milk->description
        ];

        try {
            $milk->update($data);
            toastr()->success(trans('crud.update', ['model' => 'milk']));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function delete(Milk $milk)
    {
        return view('backend.milk.delete', ['milk' => $milk]);
    }
    public function destroy(Milk $milk)
    {
        try {
            $milk->delete();
            toastr()->success(trans('crud.delete', ['model' => 'milk']));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}