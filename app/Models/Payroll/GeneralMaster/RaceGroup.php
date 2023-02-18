<?php

namespace App\Models\Payroll\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceGroup extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11901L05';
    protected $primaryKey = 'GMRAHUniqueId';
    protected $fillable = 
        [
            'GMRAHUniqueId',
            'GMRAHRaceId', 
            'GMRAHDesc1', 
            'GMRAHDesc2', 
            'GMRAHBiDesc', 
            'GMRAHMarkForDeletion',
            'GMRAHUser',
            'GMRAHLastCreated',
            'GMRAHLastUpdated',
            'GMRAHDeletedAt'
        ];
        protected $casts = [
            'GMRAHLastCreated' => 'datetime:d/m/Y',
            'GMRAHLastUpdated' => 'datetime:d/m/Y',
            'GMRAHDeletedAt' => 'datetime:d/m/Y'
        ];
}
