<?php

namespace App\Models\Payroll\EmployeeStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11903L03';
    protected $primaryKey = 'ESDPHUniqueId';
    protected $fillable = 
        [
            'ESDPHUniqueId',
            'ESDPHDepartmentId', 
            'ESDPHDesc1', 
            'ESDPHDesc2', 
            'ESDPHBiDesc', 
            'ESDPHMarkForDeletion',
            'ESDPHUser',
            'ESDPHLastCreated',
            'ESDPHLastUpdated',
            'ESDPHDeletedAt'
        ];
        protected $casts = [
            'ESDPHLastCreated' => 'datetime:d/m/Y',
            'ESDPHLastUpdated' => 'datetime:d/m/Y',
            'ESDPHDeletedAt' => 'datetime:d/m/Y'
        ];
}
