<?php

namespace App\Models\CommonMasters\FiscalYear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemMaintainCalendar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zmem05903l05';
    protected $primaryKey = 'FYCOHUniqueId';
    protected $fillable = 
        [
            'FYCOHUniqueId',
            'FYCOHCompId',
            'FYCOHCalendarId',
            'FYCOHFiscalYearId',
            'FYCOHOffDate',
            'FYCOHOffDateReason',
            'FYCOHOffDayCode',
            'FYCOHDesc',
            'FYCOHBiDesc',
            'FYCOHMarkForDeletion',
            'FYCOHUser',
            'FYCOHLastCreated',
            'FYCOHLastUpdated',
            'FYCOHDeletedAt',
        ];
        protected $casts = [
            'FYCOHLastCreated'      => 'datetime:d/m/Y',
            'FYCOHLastUpdated'      => 'datetime:d/m/Y',
            'FYCOHDeletedAt'        => 'datetime:d/m/Y'
        ];
}