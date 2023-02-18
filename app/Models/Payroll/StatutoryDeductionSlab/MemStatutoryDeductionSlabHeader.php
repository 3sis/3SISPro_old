<?php

namespace App\Models\Payroll\StatutoryDeductionSlab;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemStatutoryDeductionSlabHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zmem11906l04';
    protected $primaryKey = 'PMDSHUniqueId';
    protected $fillable = 
        [
            'PMDSHUniqueId',
            'PMDSHUniqueIdM',
            'PMDSHRuleId', 
            'PMDSHIncOrDed',
            'PMDSHDesc1',
            'PMDSHHierarchyId', 
            'PMDSHGeographicId',
            'PMDSHGenderId',
            'PMDSHEffectiveFrom',
            'PMDSHEffectiveTo',
            'PMDSHIncomeFrom',
            'PMDSHMarkForDeletion',
            'PMDSHUser',
            'PMDSHStatusId',
            'PMDSHLastCreated',
            'PMDSHLastUpdated',
            'PMDSHDeletedAt'
        ];
        protected $casts = [
            'PMDSHEffectiveFrom'      => 'datetime:d/m/Y',
            'PMDSHEffectiveTo'      => 'datetime:d/m/Y',
            'PMDSHLastCreated'      => 'datetime:d/m/Y',
            'PMDSHLastUpdated'      => 'datetime:d/m/Y',
            'PMDSHDeletedAt'        => 'datetime:d/m/Y'
        ];  
}
