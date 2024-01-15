<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Backend\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\Currency;
use Illuminate\Http\Request;

use Spatie\Image\Image;

class CompanyController extends Controller
{
    protected $imageManager;

    function __construct()
    {
        $this->imageManager = Image::useImageDriver('gd');;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::all();
        $company = Company::first();
        return view('backend.company.index', ['company' => $company, 'currencies' => $currencies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $data = [
            "name" => $request->name ?: $company->name,
            "email" => $request->email ?: $company->email,
            "phone" => $request->phone ?: $company->phone,
            "address" => $request->address ?: $company->address,
            "city" => $request->city ?: $company->city,
            "state" => $request->state ?: $company->state,
            "postal_code" => $request->postal_code ?: $company->postal_code,
            "country" => $request->country ?: $company->country,
            "gst_number" => $request->gst_number ?: $company->gst_number,
            "pan_number" => $request->pan_number ?: $company->pan_number,
            "upi" => $request->upi ?: $company->upi,
            "website" => $request->website ?: $company->website,
            'currencies_id' => $request->currencies_id ?: $company->currencies_id,
        ];

        if($request->hasFile('upi_barcode')){
            $barcode = $request->file('upi_barcode');
            $data["upi_barcode"] = $this->imageManager->loadFile($barcode->getRealPath())->width(200)->height(200)->base64();
        }

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $data["logo"] = $this->imageManager->loadFile($logo->getRealPath())->width(176)->height(110)->base64();
        }

        if($request->hasFile('fevicon')){
            $fevicon = $request->file('fevicon');
            $data["fevicon"] = $this->imageManager->loadFile($fevicon->getRealPath())->width(32)->height(32)->base64();
        }

        try {
            // Update the company record
            $company->update($data);

            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'company']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
