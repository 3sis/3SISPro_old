<?php

namespace App\Models\Payroll\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReligionMaster extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11901L06';
    protected $primaryKey = 'GMRLHUniqueId';
    protected $fillable = 
        [
            'GMRLHUniqueId',
            'GMRLHReligionId', 
            'GMRLHDesc1', 
            'GMRLHDesc2', 
            'GMRLHBiDesc', 
            'GMRLHMarkForDeletion',
            'GMRLHUser',
            'GMRLHLastCreated',
            'GMRLHLastUpdated',
            'GMRLHDeletedAt'
        ];
        protected $casts = [
            'GMRLHLastCreated' => 'datetime:d/m/Y',
            'GMRLHLastUpdated' => 'datetime:d/m/Y',
            'GMRLHDeletedAt' => 'datetime:d/m/Y'
        ];
}
