<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrenctSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $currencies = Currency::latest()->paginate(10);
        return view('backend.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'max:5'],
            'name' => ['required', 'max:50','unique:currencies,code'],
            'symbol' => ['required', 'max:5'],
            'description' => ['sometimes', 'string']
        ]);

        try {

            Currency::create([
                'code' => $request->code,
                'name' => $request->name,
                'symbol' => $request->symbol,
                'description' => $request->description,
            ]);

            toastr()->success(trans('crud.create', ['model' => 'currency']));
            return redirect()->back();

        } catch (\Exception $e) {

            toastr()->error($e->getMessage());
            return redirect()->back();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return view('backend.currency.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'code' => ['required', 'max:5','unique:currencies,code,'.$currency->id],
            'name' => ['required', 'max:50'],
            'symbol' => ['required', 'max:5'],
            'description' => ['sometimes', 'string']
        ]);

        try {

          $currency->update([
                'code' => $request->code,
                'name' => $request->name,
                'symbol' => $request->symbol,
                'description' => $request->description,
            ]);

            toastr()->success(trans('crud.update', ['model' => 'currency']));
            return redirect()->back();

        } catch (\Exception $e) {

            toastr()->error($e->getMessage());
            return redirect()->back();

        }
    }

    public function delete(Currency $currency)
    {
        return view('backend.currency.delete', ['currency' => $currency]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        try {

            $currency->delete();

            toastr()->success(trans('crud.delete', ['model' => 'currency']));

            return redirect()->back();

        } catch (\Exception $e) {

            toastr()->error($e->getMessage());

            return redirect()->back();

        }
    }
}
