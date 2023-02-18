<?php

namespace App\Models\Payroll\EmployeeStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11903L01';
    protected $primaryKey = 'ESDEHUniqueId';
    protected $fillable = 
        [
            'ESDEHUniqueId',
            'ESDEHDesignationId', 
            'ESDEHDesc1', 
            'ESDEHDesc2', 
            'ESDEHBiDesc', 
            'ESDEHMarkForDeletion',
            'ESDEHUser',
            'ESDEHLastCreated',
            'ESDEHLastUpdated',
            'ESDEHDeletedAt'
        ];
        protected $casts = [
            'ESDEHLastCreated' => 'datetime:d/m/Y',
            'ESDEHLastUpdated' => 'datetime:d/m/Y',
            'ESDEHDeletedAt' => 'datetime:d/m/Y'
        ];
}
