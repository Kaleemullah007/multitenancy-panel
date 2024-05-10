<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {


        return User::query()->when(request('id'), function ($q) {
            return $q->where('id', '>', 1);
        })->select(['name', 'email'])->get();
    }
}
