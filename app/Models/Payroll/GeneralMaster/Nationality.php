<?php

namespace App\Models\Payroll\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11901L04';
    protected $primaryKey = 'GMNAHUniqueId';
    protected $fillable = 
        [
            'GMNAHUniqueId',
            'GMNAHNationalityId', 
            'GMNAHDesc1', 
            'GMNAHDesc2', 
            'GMNAHBiDesc', 
            'GMNAHMarkForDeletion',
            'GMNAHUser',
            'GMNAHLastCreated',
            'GMNAHLastUpdated',
            'GMNAHDeletedAt'
        ];
        protected $casts = [
            'GMNAHLastCreated' => 'datetime:d/m/Y',
            'GMNAHLastUpdated' => 'datetime:d/m/Y',
            'GMNAHDeletedAt' => 'datetime:d/m/Y'
        ];
}
