<?php

namespace App\Models\CommonMasters\FiscalYear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05903L01';
    protected $primaryKey = 'FYFYHUniqueId';
    protected $fillable = 
        [
            'FYFYHUniqueId',
            'FYFYHCompanyId',
            'FYFYHFiscalYearId', 
            'FYFYHStartDate', 
            'FYFYHEndDate', 
            'FYFYHCurrentFY', 
            'FYFYHCurrentPeriod', 
            'FYFYHPeriodStartDate', 
            'FYFYHPeriodEndDate', 
            'FYFYHMarkForDeletion',
            'FYFYHUser',
            'FYFYHLastCreated',
            'FYFYHLastUpdated',
            'FYFYHDeletedAt'
        ];
        protected $casts = [
            'FYFYHStartDate'        => 'datetime:d/m/Y',
            'FYFYHEndDate'          => 'datetime:d/m/Y',
            'FYFYHPeriodStartDate'  => 'datetime:d/m/Y',
            'FYFYHPeriodEndDate'    => 'datetime:d/m/Y',
            'FYFYHLastCreated'      => 'datetime:d/m/Y',
            'FYFYHLastUpdated'      => 'datetime:d/m/Y',
            'FYFYHDeletedAt'        => 'datetime:d/m/Y'
        ];
}
