<?php

namespace App\Models\Payroll\IncomeDeductionType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionType extends Model
{
    use HasFactory;    
    public $timestamps = false;
    protected $table = 'T11906l02';
    protected $primaryKey = 'PMDTHUniqueId';
    protected $fillable = 
        [
            'PMDTHUniqueId',
            'PMDTHDeductionId', 
            'PMDTHDeductionIdK',
            'PMDTHDesc1', 
            'PMDTHDesc2', 
            'PMDTHApplicableFor',
            'PMDTHIsTaxExempted',
            'PMDTHIsThisLoanLine',
            'PMDTHShowInTaxList',
            'PMDTHIsIncomeDependent',
            'PMDTHDedStrategy',
            'PMDTHDedStrategyDesc',
            'PMDTHDeductionCycle',
            'PMDTHDedPercent',
            'PMDTHRuleId',
            'PMDTHPrintingSeq',
            'PMDTHRoundingStrategy',
            'PMDTHBiElementId',
            'PMDTHMarkForDeletion',
            'PMDTHUser',
            'PMDTHLastCreated',
            'PMDTHLastUpdated'
        ];
        protected $casts = [
            'PMDTHLastCreated' => 'datetime:d/m/Y',
            'PMDTHLastUpdated' => 'datetime:d/m/Y',
            'PMDTHDeletedAt' => 'datetime:d/m/Y'
        ];
}
