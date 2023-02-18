<?php

namespace App\Models\Payroll\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11901L07';
    protected $primaryKey = 'GMMSHUniqueId';
    protected $fillable = 
        [
            'GMMSHUniqueId',
            'GMMSHMaritalStatusId', 
            'GMMSHDesc1', 
            'GMMSHDesc2', 
            'GMMSHBiDesc', 
            'GMMSHMarkForDeletion',
            'GMMSHUser',
            'GMMSHLastCreated',
            'GMMSHLastUpdated',
            'GMMSHDeletedAt'
        ];
        protected $casts = [
            'GMMSHLastCreated' => 'datetime:d/m/Y',
            'GMMSHLastUpdated' => 'datetime:d/m/Y',
            'GMMSHDeletedAt' => 'datetime:d/m/Y'
        ];
}
