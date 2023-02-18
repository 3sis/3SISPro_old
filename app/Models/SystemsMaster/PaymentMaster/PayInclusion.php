<?php

namespace App\Models\SystemsMaster\PaymentMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayInclusion extends Model
{
    use HasFactory;
    protected $table = 't00903l01';
    protected $primaryKey = 'PMPIHUniqueId';
    protected $fillable = 
        [
            'PMPIHUniqueId',
            'PMPIHPayInclusionId', 
            'PMPIHShortDesc', 
            'PMPIHDesc1', 
            'PMPIHDesc2',
            'PMPIHIncludeInPayCal',
            'PMPIHDayStatus',
            'PMPIHBiDesc',
            'PMPIHMarkForDeletion',
            'PMPIHUser',
            'PMPIHLastCreated',
            'PMPIHLastUpdated',
            'PMPIHDeletedAt'
        ];
        protected $casts = [
            'PMPIHLastCreated'  => 'datetime:d/m/Y',
            'PMPIHLastUpdated'  => 'datetime:d/m/Y',
            'PMPIHDeletedAt'    => 'datetime:d/m/Y'
        ];
}
