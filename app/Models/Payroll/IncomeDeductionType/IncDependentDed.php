<?php

namespace App\Models\Payroll\IncomeDeductionType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncDependentDed extends Model
{
    use HasFactory;    
    public $timestamps = false;
    protected $table = 'T11906l0211';
    protected $primaryKey = 'PMDTDUniqueId';
    protected $fillable = 
        [
            'PMDTDUniqueId',
            'PMDTDUniqueIdH',
            'PMDTDDeductionId', 
            'PMDTDDeductionIdK',
            'PMDTDIncomeId', 
            'PMDTDIncomeIdK',
            'PMDTDIsSelect',
            'PMDTDDedPercent',
            'PMDTDMarkForDeletion',
            'PMDTDUser',
            'PMDTDLastCreated',
            'PMDTDLastUpdated'
        ];
        protected $casts = [
            'PMDTDLastCreated'  => 'datetime:d/m/Y',
            'PMDTDLastUpdated'  => 'datetime:d/m/Y',
            'PMDTDDeletedAt'    => 'datetime:d/m/Y'
        ];
}
