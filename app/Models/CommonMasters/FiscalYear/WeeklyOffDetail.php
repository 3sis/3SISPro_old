<?php

namespace App\Models\CommonMasters\FiscalYear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyOffDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05903l0311';
    protected $primaryKey = 'FYWODUniqueId';
    protected $fillable = 
        [
            'FYWODUniqueId',
            'FYWODUniqueIdH',
            'FYWODCalendarId',
            'FYWODFiscalYearId',
            'FYWODHolidayType',
            'FYWODDayId',
            'FYWODDesc1',
            'FYWODDesc2',
            'FYWODAll',
            'FYWODFirst',
            'FYWODSecond',
            'FYWODThird',
            'FYWODFourth',
            'FYWODFifth',
            'FYWODBiDesc',
            'FYWODMarkForDeletion',
            'FYWODUser',
            'FYWODLastCreated',
            'FYWODLastUpdated',
            'FYWODDeletedAt'
        ];
        protected $casts = [
            'FYWODLastCreated'      => 'datetime:d/m/Y',
            'FYWODLastUpdated'      => 'datetime:d/m/Y',
            'FYWODDeletedAt'        => 'datetime:d/m/Y'
        ];
}
