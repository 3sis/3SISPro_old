<?php

namespace App\Models\CommonMasters\FiscalYear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyOffHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05903l03';
    protected $primaryKey = 'FYWOHUniqueId';
    protected $fillable = 
        [
            'FYWOHUniqueId',
            'FYWOHCalendarId',
            'FYWOHFiscalYearId',
            'FYWOHDesc1',
            'FYWOHDesc2',
            'FYWOHSunday',
            'FYWOHMonday',
            'FYWOHTuesday',
            'FYWOHWednesday',
            'FYWOHThursday',
            'FYWOHFriday',
            'FYWOHSaturday',
            'FYWOHTotalWeeklyOff',
            'FYWOHBiDesc',
            'FYWOHMarkForDeletion',
            'FYWOHUser',
            'FYWOHLastCreated',
            'FYWOHLastUpdated',
            'FYWOHDeletedAt'
        ];
        protected $casts = [
            'FYWOHLastCreated'      => 'datetime:d/m/Y',
            'FYWOHLastUpdated'      => 'datetime:d/m/Y',
            'FYWOHDeletedAt'        => 'datetime:d/m/Y'
        ];
}
