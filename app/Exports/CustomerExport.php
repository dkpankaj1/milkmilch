<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExport implements FromCollection,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }
    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->user->name,
            $customer->user->email,
            $customer->user->phone,       

        ];
    }
}
