<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Traits\HttpResponses;

class SettingController extends Controller
{
    use HttpResponses;
    public function index()
    {
        return $this->sendSuccess("settings", [
            'settings' => Company::select([
                'name',
                'email',
                'phone',
                'address',
                'city',
                'state',
                'postal_code',
                'country',
                'upi',
                'upi_barcode',
            ])->get()
        ], 200);
    }
}
