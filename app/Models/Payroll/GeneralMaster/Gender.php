<?php

namespace App\Models\Payroll\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11901L02';
    protected $primaryKey = 'GMGDHUniqueId';
    protected $fillable = 
        [
            'GMGDHUniqueId',
            'GMGDHGenderId', 
            'GMGDHDesc1', 
            'GMGDHDesc2', 
            'GMGDHBiDesc', 
            'GMGDHMarkForDeletion',
            'GMGDHUser',
            'GMGDHLastCreated',
            'GMGDHLastUpdated',
            'GMGDHDeletedAt'
        ];
        protected $casts = [
            'GMGDHLastCreated' => 'datetime:d/m/Y',
            'GMGDHLastUpdated' => 'datetime:d/m/Y',
            'GMGDHDeletedAt' => 'datetime:d/m/Y'
        ];
}
