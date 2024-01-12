<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $units = Unit::latest()->paginate(10);
        return view('backend.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:units,name'],
            'description' => ['required'],
            'status' => ['required']
        ]);


        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ];

        try {
            Unit::create($data);
            toastr()->success(trans('crud.create', ['model' => 'unit']));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('backend.unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => ['required', 'unique:units,name,'.$unit->id],
            'description' => ['required'],
            'status' => ['required']
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ];

        try {
            $unit->update($data);
            toastr()->success(trans('crud.update', ['model' => 'unit']));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function delete(Unit $unit)
    {
        return view('backend.unit.delete', ['unit' => $unit]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        try {

            $unit->delete();

            toastr()->success(trans('crud.delete', ['model' => 'supplier']));

            return redirect()->back();

        } catch (\Exception $e) {

            toastr()->error($e->getMessage());

            return redirect()->back();

        }
    }
}
