<?php

namespace App\Models\Payroll\IncomeDeductionType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemIncomeType extends Model
{
    use HasFactory;    
    public $timestamps = false;
    protected $table = 'zmem11906l0211';
    protected $primaryKey = 'PMDTDUniqueId';
    protected $fillable = 
        [
            'PMDTDUniqueId',
            'PMDTDUniqueIdH',
            'PMDTDIncomeId', 
            'PMDTDIncomeIdK',
            'PMDTDDesc1',
            'PMDTDIsSelect',
            'PMDTDDedPercent',
            'PMDTDUser',
        ];
}
