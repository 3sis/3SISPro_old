<?php

namespace App\Models\SystemsMaster\PaymentMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleDefinition extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't00903l03';
    protected $primaryKey = 'PMRDHUniqueId';
    protected $fillable = 
        [
            'PMRDHUniqueId',
            'PMRDHRuleId', 
            'PMRDHIncOrDed', 
            'PMRDHDesc1', 
            'PMRDHHierarchyId',
            'PMRDHSlabDefined',
            'PMRDHDeductionEligibility',
            'PMRDHDeductionBasis',
            'PMRDHMarkForDeletion',
            'PMRDHUser',
            'PMRDHLastCreated',
            'PMRDHLastUpdated',
            'PMRDHDeletedAt'
        ];
        protected $casts = [
            'PMRDHLastCreated'  => 'datetime:d/m/Y',
            'PMRDHLastUpdated'  => 'datetime:d/m/Y',
            'PMRDHDeletedAt'    => 'datetime:d/m/Y'
        ];
}
