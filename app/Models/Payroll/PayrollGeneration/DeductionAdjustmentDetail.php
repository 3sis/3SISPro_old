<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionAdjustmentDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't11125l0311';
    protected $primaryKey = 'PGDADUniqueId';
    protected $fillable = 
        [
            'PGDADUniqueId',
            'PGDADCompanyId',
            'PGDADFiscalYear',
            'PGDADPeriodId',
            'PGDADLocationId',
            'PGDADEmployeeId',
            'PGDADIncDedId',
            'PGDADDesc1',
            'PGDADGrossDeduction',
            'PGDADNetDeduction',
            'PGDADFromDate',
            'PGDADToDate',
            'PGDADStatusId',
            'PGDADMarkForDeletion',
            'PGDADUser',
            'PGDADLastCreated',
            'PGDADLastUpdated',
            'PGDADDeletedAt'
        ];
        protected $casts = [
            'PGDADFromDate' => 'datetime:d/m/Y',
            'PGDADToDate' => 'datetime:d/m/Y',
            'PGDADLastCreated' => 'datetime:d/m/Y',
            'PGDADLastUpdated' => 'datetime:d/m/Y',
            'PGDADDeletedAt' => 'datetime:d/m/Y'
        ];
}