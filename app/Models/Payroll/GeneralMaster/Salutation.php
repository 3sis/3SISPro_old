<?php

namespace App\Models\Payroll\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salutation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11901L01';
    protected $primaryKey = 'GMSLHUniqueId';
    protected $fillable = 
        [
            'GMSLHUniqueId',
            'GMSLHSalutationId', 
            'GMSLHDesc1', 
            'GMSLHDesc2', 
            'GMSLHBiDesc', 
            'GMSLHMarkForDeletion',
            'GMSLHUser',
            'GMSLHLastCreated',
            'GMSLHLastUpdated',
            'GMSLHDeletedAt'
        ];
        protected $casts = [
            'GMSLHLastCreated' => 'datetime:d/m/Y',
            'GMSLHLastUpdated' => 'datetime:d/m/Y',
            'GMSLHDeletedAt' => 'datetime:d/m/Y'
        ];
}
