<?php

namespace App\Models\Payroll\LoanBook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanBookHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't11130l01';
    protected $primaryKey = 'LALBHUniqueId';
    protected $fillable = 
    [
        'LALBHUniqueId',
        'LALBHLoanId',
        'LALBHCompanyId',
        'LALBHLocationId',
        'LALBHEmployeeId',
        'LALBHDeductionId',
        'LALBHLoanAmount',
        'LALBHInterestAmount',
        'LALBHRecoveryAmount',
        'LALBHNoOfEMI',
        'LALBHEMIAmount',
        'LALBHTotalDeduction',
        'LALBHStartDateEMI',
        'LALBHEndDateEMI',
        'LALBHPaidEMI',
        'LALBHBalanceEMI',
        'LALBHPaidAmount',
        'LALBHBalanceAmount',
        'LALBHLoanPaidFully',
        'LALBHMarkForDeletion',
        'LALBHUser',
        'LALBHStatusId',
        'LALBHLastCreated',
        'LALBHLastUpdated',
        'LALBHDeletedAt',
    ];
    protected $casts = [
        'LALBHStartDateEMI' => 'datetime:d/m/Y',
        'LALBHEndDateEMI'   => 'datetime:d/m/Y',
        'LALBHLastCreated'  => 'datetime:d/m/Y',
        'LALBHLastUpdated'  => 'datetime:d/m/Y',
        'LALBHDeletedAt'    => 'datetime:d/m/Y'
    ];
}
