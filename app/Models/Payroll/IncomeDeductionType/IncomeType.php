<?php

namespace App\Models\Payroll\IncomeDeductionType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    use HasFactory;    
    public $timestamps = false;
    protected $table = 't11906l01';
    protected $primaryKey = 'PMITHUniqueId';
    protected $fillable = 
        [
            'PMITHUniqueId',
            'PMITHIncomeId', 
            'PMITHIncomeIdK',
            'PMITHDesc1', 
            'PMITHDesc2', 
            'PMITHIsTaxable',
            'PMITHRuleId',
            'PMITHRentExemptPercent',
            'PMITHRentCityPercent',
            'PMITHIncomeCycle',
            'PMITHPrintingSeq',
            'PMITHRoundingStrategy',
            'PMITHBiElementId',
            'PMITHMarkForDeletion',
            'PMITHUser',
            'PMITHLastCreated',
            'PMITHLastUpdated'
        ];
        protected $casts = [
            'PMITHLastCreated' => 'datetime:d/m/Y',
            'PMITHLastUpdated' => 'datetime:d/m/Y',
            'PMITHDeletedAt' => 'datetime:d/m/Y'
        ];
}
