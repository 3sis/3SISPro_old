<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySlashDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11125L0211';
    protected $primaryKey = 'PGSSDUniqueId';
    protected $fillable = 
        [
            'PGSSDUniqueId',
            'PGSSDCompanyId',
            'PGSSDFiscalYear',
            'PGSSDPeriodId',
            'PGSSDLocationId',
            'PGSSDEmployeeId',
            'PGSSDIncDedId',
            'PGSSDDesc1',
            'PGSSDGrossAmount',
            'PGSSDIncomeFixOrPercent',
            'PGSSDIncomePaymentPercent',
            'PGSSDGrossPayment',
            'PGSSDFromDate',
            'PGSSDToDate',
            'PGSSDStatusId',
            'PGSSDMarkForDeletion',
            'PGSSDUser',
            'PGSSDLastCreated',
            'PGSSDLastUpdated',
            'PGSSDDeletedAt'
        ];
        protected $casts = [
            'PGSSDFromDate' => 'datetime:d/m/Y',
            'PGSSDToDate' => 'datetime:d/m/Y',
            'PGSSDLastCreated' => 'datetime:d/m/Y',
            'PGSSDLastUpdated' => 'datetime:d/m/Y',
            'PGSSDDeletedAt' => 'datetime:d/m/Y'
        ];
}
