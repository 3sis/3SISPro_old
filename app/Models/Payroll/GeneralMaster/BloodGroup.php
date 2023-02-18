<?php

namespace App\Models\Payroll\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11901L03';
    protected $primaryKey = 'GMBGHUniqueId';
    protected $fillable = 
        [
            'GMBGHUniqueId',
            'GMBGHBloodGroupId', 
            'GMBGHDesc1', 
            'GMBGHDesc2', 
            'GMBGHBiDesc', 
            'GMBGHMarkForDeletion',
            'GMBGHUser',
            'GMBGHLastCreated',
            'GMBGHLastUpdated',
            'GMBGHDeletedAt'
        ];
        protected $casts = [
            'GMBGHLastCreated' => 'datetime:d/m/Y',
            'GMBGHLastUpdated' => 'datetime:d/m/Y',
            'GMBGHDeletedAt' => 'datetime:d/m/Y'
        ];
}
