<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdhocPaymentPeriod extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11125L0411';
    protected $primaryKey = 'PGAIDUniqueId';
    protected $fillable = 
    [
        'PGAIDUniqueId',
        'PGAIDCompanyId',
        'PGAIDFiscalYear',
        'PGAIDPeriodId',
        'PGAIDLocationId',
        'PGAIDEmployeeId',
        'PGAIDIncDedId',
        'PGAIDDesc1',
        'PGAIDGrossAmount',
        'PGAIDGrossPayment',
        'PGAIDFromDate',
        'PGAIDToDate',
        'PGAIDStatusId',
        'PGAIDMarkForDeletion',
        'PGAIDUser',
        'PGAIDLastCreated',
        'PGAIDLastUpdated',
        'PGAIDDeletedAt'
    ];
    protected $casts = [
        'PGAIDFromDate' => 'datetime:d/m/Y',
        'PGAIDToDate' => 'datetime:d/m/Y',
        'PGAIDLastCreated' => 'datetime:d/m/Y',
        'PGAIDLastUpdated' => 'datetime:d/m/Y',
        'PGAIDDeletedAt' => 'datetime:d/m/Y'
    ];
}
