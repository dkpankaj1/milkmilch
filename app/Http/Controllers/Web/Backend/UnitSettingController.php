<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

/**
 * Class UnitSettingController
 *
 * @package App\Http\Controllers\Web\Backend
 */
class UnitSettingController extends Controller
{
    /**
     * Display a paginated list of units.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Retrieve and paginate the latest units
        $units = Unit::latest()->paginate(10);
        return view('backend.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new unit.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.unit.create');
    }

    /**
     * Store a newly created unit in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
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
            // Create a new unit record
            Unit::create($data);

            // Display success message and redirect back
            toastr()->success(trans('crud.create', ['model' => 'unit']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified unit.
     *
     * @param  Unit  $unit
     * @return void
     */
    public function show(Unit $unit)
    {
        // No specific action for showing a unit
    }

    /**
     * Show the form for editing the specified unit.
     *
     * @param  Unit  $unit
     * @return \Illuminate\View\View
     */
    public function edit(Unit $unit)
    {
        return view('backend.unit.edit', compact('unit'));
    }

    /**
     * Update the specified unit in storage.
     *
     * @param  Request  $request
     * @param  Unit  $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Unit $unit)
    {
        // Validate the incoming request
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
            // Update the unit record
            $unit->update($data);

            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'unit']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for confirming the deletion of the specified unit.
     *
     * @param  Unit  $unit
     * @return \Illuminate\View\View
     */
    public function delete(Unit $unit)
    {
        return view('backend.unit.delete', ['unit' => $unit]);
    }

    /**
     * Remove the specified unit from storage.
     *
     * @param  Unit  $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Unit $unit)
    {
        try {
            // Delete the unit record
            $unit->delete();

            // Display success message and redirect back
            toastr()->success(trans('crud.delete', ['model' => 'unit']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
