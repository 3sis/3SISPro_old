<?php

namespace App\Models\Payroll\StatutoryDeductionSlab;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemStatutoryDeductionSlabDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zmem11906l0411';
    protected $primaryKey = 'PMDSDUniqueId';
    protected $fillable = 
        [
            'PMDSDUniqueId',
            'PMDSDUniqueIdH',
            'PMDSDUniqueIdM',
            'PMDSDRuleId', 
            'PMDSDLineId', 
            'PMDSDIncOrDed',
            'PMDSDDesc1',
            'PMDSDHierarchyId', 
            'PMDSDGeographicId',
            'PMDSDGenderId',
            'PMDSDEffectiveFrom',
            'PMDSDEffectiveTo',
            'PMDSDIncomeFrom',
            'PMDSDIncomeTo',
            'PMDSDEmpContriType',
            'PMDSDEmpContriAmount',
            'PMDSDCompContriType',
            'PMDSDCompContriAmount',
            'PMDSDMarkForDeletion',
            'PMDSDUser',
            'PMDSDStatusId',
            'PMDSDLastCreated',
            'PMDSDLastUpdated',
            'PMDSDDeletedAt'
        ];
        protected $casts = [
            'PMDSDEffectiveFrom'    => 'datetime:d/m/Y',
            'PMDSDEffectiveTo'      => 'datetime:d/m/Y',
            'PMDSDLastCreated'      => 'datetime:d/m/Y',
            'PMDSDLastUpdated'      => 'datetime:d/m/Y',
            'PMDSDDeletedAt'        => 'datetime:d/m/Y'
        ];  
}
