<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemSalaryRevisionXL extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mem11126L04';
    protected $primaryKey = 'PGSRHUniqueId';
    protected $fillable = 
        [
            'PGSRHUniqueId',
            'PGSRHCompanyId', 
            'PGSRHEmployeeId',
            'PGSRHEffectiveFrom',
            'PGSRHEffectiveTo',
            'PGSRHRevisedAmt',
            'PGSRHFixedOrPercent',
            'PGSRHSelect',
            'PGSRHUser',
            'PGSRHLastCreated'
        ];
        protected $casts = [
            'PGSRHEffectiveFrom'    => 'datetime:d/m/Y',
            'PGSRHEffectiveTo'      => 'datetime:d/m/Y',
            'PGSRHLastCreated'      => 'datetime:d/m/Y'
        ];
}
