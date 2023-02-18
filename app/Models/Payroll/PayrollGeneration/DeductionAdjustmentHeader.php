<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionAdjustmentHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't11125l03';
    protected $primaryKey = 'PGDAHUniqueId';
    protected $fillable = 
        [
            'PGDAHUniqueId',
            'PGDAHCompanyId',
            'PGDAHFiscalYear',
            'PGDAHPeriodId',
            'PGDAHLocationId',
            'PGDAHEmployeeId',
            'PGDAHFromDate',
            'PGDAHToDate',
            'PGDAHCurrentIncome',
            'PGDAHIncreaseDecrese',
            'PGDAHRevisedIncome',
            'PGDAHStatusId',
            'PGDAHMarkForDeletion',
            'PGDAHUser',
            'PGDAHLastCreated',
            'PGDAHLastUpdated',
            'PGDAHDeletedAt'
        ];
        protected $casts = [
            'PGDAHFromDate' => 'datetime:d/m/Y',
            'PGDAHToDate' => 'datetime:d/m/Y',
            'PGDAHLastCreated' => 'datetime:d/m/Y',
            'PGDAHLastUpdated' => 'datetime:d/m/Y',
            'PGDAHDeletedAt' => 'datetime:d/m/Y'
        ];
}
