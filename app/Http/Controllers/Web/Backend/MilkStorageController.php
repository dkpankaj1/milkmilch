<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\MilkStorage;
use App\Models\Product;

class MilkStorageController extends Controller
{
    public function index()
    {
        $milkStorages = MilkStorage::latest()->with('milk')->get();
        return view('backend.milk-storage.index', compact('milkStorages'));
    }

    public function milkProcessing_create(MilkStorage $milkstorage)
    {
        $products = Product::latest()->where('status',1)->get();
        return view('backend.milk-storage.process',['milkStorages' => $milkstorage,'products' => $products]);
    }

    public function milkProcessing_store()
    {

    }

    public function milkTransfer_create()
    {

    }

    public function milkTransfer_post()
    {
        
    }   
    
}
