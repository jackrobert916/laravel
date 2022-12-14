<?php

namespace App\Exports;

use App\Drug;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,  WithHeadings
{
    // public function getCsvSettings(): array
    // {
    //     return [
    //         'delimiter' => '[]'
    //     ];
    // }

    public function headings(): array
    {
        return ["trade_name","generic_name","note","Price","Stock"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Drug::select('trade_name','generic_name','note','Price','Stock')->get();
    }
}
