<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class Drug extends Model
{
    protected $table = 'drugs';
    protected $fillable = ['trade_name','generic_name','note','Price','Stock'];

    public function Prescription(){
                return $this->hasMany('App\Prescription_drug');
    }

}
