<?php
namespace App\Imports;
use App\Drug;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class UserImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new drug([
           'trade_name'     => (isset($row[0]) ? $row[0] : ''),
           'generic_name'   => (isset($row[1]) ? $row[1] : ''),
           'note'           => (isset($row[2]) ? $row[2] : ''),
           'Price'          => (isset($row[3]) ? $row[3] : ''),
           'Stock'          => (isset($row[4]) ? $row[4] : ''),
        ]);
    }
}