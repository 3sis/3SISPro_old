<?php

namespace App\Models\Payroll\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11901L08';
    protected $primaryKey = 'GMPSHUniqueId';
    protected $fillable = 
        [
            'GMPSHUniqueId',
            'GMPSHPhysicalStatusId', 
            'GMPSHDesc1', 
            'GMPSHDesc2', 
            'GMPSHBiDesc', 
            'GMPSHMarkForDeletion',
            'GMPSHUser',
            'GMPSHLastCreated',
            'GMPSHLastUpdated',
            'GMPSHDeletedAt'
        ];
        protected $casts = [
            'GMPSHLastCreated' => 'datetime:d/m/Y',
            'GMPSHLastUpdated' => 'datetime:d/m/Y',
            'GMPSHDeletedAt' => 'datetime:d/m/Y'
        ];
}
