<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemPayrollDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zmem11125l0811';
    protected $primaryKey = 'PGGPDUniqueId';
    protected $fillable = 
    [
        'PGGPDUniqueId',
        'PGGPDUniqueIdH',
        'PGGPDCompanyId',
        'PGGPDLocationId',
        'PGGPDEmployeeId',
        'PGGPDDesignationId',
        'PGGPDFiscalYear',
        'PGGPDPeriodId',
        'PGGPDPeriodMonth',
        'PGGPDFromDate',
        'PGGPDToDate',
        'PGGPDSysId',
        'PGGPDUserSorting',
        'PGGPDIncDedId',
        'PGGPDIncOrDed',
        'PGGPDDesc',
        'PGGPDGrossIncome',
        'PGGPDGrossPay',
        'PGGPDPayrollAmt',
        'PGGPDUserEditedAmt',
        'PGGPDCompContriGross',
        'PGGPDCompContriNet',
        'PGGPDCompContriUserEditedAmt',
        'PGGPDCaldendarDays',
        'PGGPDPresentDays',
        'PGGPDAbsentDays',
        'PGGPDWeeklyOff',
        'PGGPDPublicHolidays',
        'PGGPDPaidLeave',
        'PGGPDLeaveWithoutPay',
        'PGGPDPaidDays',
        'PGGPDUser',
        'PGGPDStatusId',
        'PGGPDLastCreated',
        'PGGPDLastUpdated',
        'PGGPDDeletedAt',
    ]; 
    protected $casts = [
        'PGGPDFromDate'     => 'datetime:d/m/Y',
        'PGGPDToDate'       => 'datetime:d/m/Y',
        'PGGPDLastCreated'  => 'datetime:d/m/Y',
        'PGGPDLastUpdated'  => 'datetime:d/m/Y',
        'PGGPDDeletedAt'    => 'datetime:d/m/Y'
    ];

}
