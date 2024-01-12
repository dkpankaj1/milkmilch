<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class CurrencySettingController
 *
 * @package App\Http\Controllers\Web\Backend
 */
class CurrencySettingController extends Controller
{
    /**
     * Display a listing of the currencies.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Retrieve and paginate the latest currencies
        $currencies = Currency::latest()->paginate(10);
        return view('backend.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new currency.
     *
     * @return View
     */
    public function create(): View
    {
        return view('backend.currency.create');
    }

    /**
     * Store a newly created currency in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'code' => ['required', 'max:5'],
            'name' => ['required', 'max:50', 'unique:currencies,code'],
            'symbol' => ['required', 'max:5'],
            'description' => ['sometimes', 'string'],
        ]);

        try {
            // Create a new currency record
            Currency::create([
                'code' => $request->code,
                'name' => $request->name,
                'symbol' => $request->symbol,
                'description' => $request->description,
            ]);

            // Display success message and redirect back
            toastr()->success(trans('crud.create', ['model' => 'currency']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified currency.
     *
     * @param  Currency  $currency
     * @return void
     */
    public function show(Currency $currency)
    {
        // No specific action for showing a currency
    }

    /**
     * Show the form for editing the specified currency.
     *
     * @param  Currency  $currency
     * @return View
     */
    public function edit(Currency $currency)
    {
        return view('backend.currency.edit', compact('currency'));
    }

    /**
     * Update the specified currency in storage.
     *
     * @param  Request  $request
     * @param  Currency  $currency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Currency $currency)
    {
        // Validate the incoming request
        $request->validate([
            'code' => ['required', 'max:5', 'unique:currencies,code,' . $currency->id],
            'name' => ['required', 'max:50'],
            'symbol' => ['required', 'max:5'],
            'description' => ['sometimes', 'string'],
        ]);

        try {
            // Update the currency record
            $currency->update([
                'code' => $request->code,
                'name' => $request->name,
                'symbol' => $request->symbol,
                'description' => $request->description,
            ]);

            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'currency']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for confirming the deletion of the specified currency.
     *
     * @param  Currency  $currency
     * @return View
     */
    public function delete(Currency $currency)
    {
        return view('backend.currency.delete', ['currency' => $currency]);
    }

    /**
     * Remove the specified currency from storage.
     *
     * @param  Currency  $currency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Currency $currency)
    {
        try {
            // Delete the currency record
            $currency->delete();

            // Display success message and redirect back
            toastr()->success(trans('crud.delete', ['model' => 'currency']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
