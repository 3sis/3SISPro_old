<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoPayDays extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't11125l01';
    protected $primaryKey = 'PGADHUniqueId';
    protected $fillable = 
        [
            'PGADHUniqueId',
            'PGADHCompanyId',
            'PGADHEmployeeId',
            'PGADHLocationId',
            'PGADHFiscalYearId',
            'PGADHPeriodId',
            'PGADHPeriodMonth',
            'PGADHTotalDays',
            'PGADHNoPayDays',
            'PGADHPaidDays',
            'PGADHMarkForDeletion',
            'PGADHUser',
            'PGADHStatusId',
            'PGADHLastCreated',
            'PGADHLastUpdated',
            'PGADHDeletedAt',
        ];
        protected $casts = [
            'PGADHLastCreated'  => 'datetime:d/m/Y',
            'PGADHLastUpdated'  => 'datetime:d/m/Y',
            'PGADHDeletedAt'    => 'datetime:d/m/Y'
        ];
}
