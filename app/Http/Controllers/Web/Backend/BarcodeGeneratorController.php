<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarcodeGeneratorController extends Controller
{
    public function generate(Request $request){
        return view('backend.product.barcode', ['text' => $request->text]);
    }
}
