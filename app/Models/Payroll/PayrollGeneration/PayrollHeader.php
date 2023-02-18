<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't11125l08';
    protected $primaryKey = 'PGGPHUniqueId';
    protected $fillable = 
    [
        'PGGPHUniqueId',
        'PGGPHCompanyId',
        'PGGPHLocationId',
        'PGGPHEmpCode',
        'PGGPHDesigId',
        'PGGPHFiscalYear',
        'PGGPHFiscalPeriod',
        'PGGPHFiscalMonth',
        'PGGPHFromDate',
        'PGGPHToDate',
        'PGGPHCaldendarDays',
        'PGGPHEmployeeCaldendarDays',
        'PGGPHAbsentDays',
        'PGGPHWeeklyOff',
        'PGGPHPublicHoliday',
        'PGGPHPaidLeaves',
        'PGGPHLeaveWithoutyPay',
        'PGGPHPaidDays',
        'PGGPHGrossIncome',
        'PGGPHGrossPay',
        'PGGPHPayrollAmt',
        'PGGPHUserEditedAmt',
        'PGGPHGrossDeduction',
        'PGGPHNetDeduction',
        'PGGPHGrossCompContri',
        'PGGPHNetCompContri',
        'PGGPHGrossPaid',
        'PGGPHNetPaid',
        'PGGPHEmploymentType',
        'PGGPHGradeId',
        'PGGPHDeptartmentId',
        'PGGPHSlashSalary',
        'PGGPHLWPSalary',
        'PGGPHUser',
        'PGGPHStatusId',
        'PGGPHLastCreated',
        'PGGPHLastUpdated',
        'PGGPHDeletedAt',

    ]; 
    protected $casts = [
        'PGGPHFromDate'     => 'datetime:d/m/Y',
        'PGGPHToDate'       => 'datetime:d/m/Y',
        'PGGPHLastCreated'  => 'datetime:d/m/Y',
        'PGGPHLastUpdated'  => 'datetime:d/m/Y',
        'PGGPHDeletedAt'    => 'datetime:d/m/Y'
    ];

}
