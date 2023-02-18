<?php

namespace App\Models\Payroll\LoanBook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemLoanBookDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zmem11130l0111';
    protected $primaryKey = 'LALBDUniqueId';
    protected $fillable = 
    [
        'LALBDUniqueId',
        'LALBDUniqueIdH',
        'LALBDLoanId',
        'LALBDCompanyId',
        'LALBDLocationId',
        'LALBDEmployeeId',
        'LALBDDeductionId',
        'LALBDLineNo',
        'LALBDEMIAmount',
        'LALBDPaidAmount',
        'LALBDBalanceAmount',
        'LALBDStartDateEMI',
        'LALBDEndDateEMI',
        'LALBDMarkForDeletion',
        'LALBDUser',
        'LALBDStatusId',
        'LALBDLastCreated',
        'LALBDLastUpdated',
        'LALBDDeletedAt',
    ]; 
    protected $casts = [
        'LALBDStartDateEMI' => 'datetime:d/m/Y',
        'LALBDEndDateEMI'   => 'datetime:d/m/Y',
        'LALBDLastCreated'  => 'datetime:d/m/Y',
        'LALBDLastUpdated'  => 'datetime:d/m/Y',
        'LALBDDeletedAt'    => 'datetime:d/m/Y'
    ];
}
