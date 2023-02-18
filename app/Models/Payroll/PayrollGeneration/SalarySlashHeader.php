<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySlashHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11125L02';
    protected $primaryKey = 'PGSSHUniqueId';
    protected $fillable = 
        [
            'PGSSHUniqueId',
            'PGSSHCompanyId',
            'PGSSHFiscalYear',
            'PGSSHPeriodId',
            'PGSSHLocationId',
            'PGSSHEmployeeId',
            'PGSSHFromDate',
            'PGSSHToDate',
            'PGSSHCurrentIncome',
            'PGSSHIncreaseDecrese',
            'PGSSHRevisedIncome',
            'PGSSHStatusId',
            'PGSSHMarkForDeletion',
            'PGSSHUser',
            'PGSSHLastCreated',
            'PGSSHLastUpdated',
            'PGSSHDeletedAt'
        ];
        protected $casts = [
            'PGSSHFromDate' => 'datetime:d/m/Y',
            'PGSSHToDate' => 'datetime:d/m/Y',
            'PGSSHLastCreated' => 'datetime:d/m/Y',
            'PGSSHLastUpdated' => 'datetime:d/m/Y',
            'PGSSHDeletedAt' => 'datetime:d/m/Y'
        ];
}
