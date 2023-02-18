<?php

namespace App\Models\CommonMasters\FiscalYear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicHolidayDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05903l0411';
    protected $primaryKey = 'FYPHDUniqueId';
    protected $fillable = 
        [
            'FYPHDUniqueId',
            'FYPHDUniqueIdH',
            'FYPHDCalendarId',
            'FYPHDFiscalYearId',
            'FYPHDHolidayType',
            'FYPHDHolidayDate',
            'FYPHDDesc1',
            'FYPHDDesc2',
            'FYPHDBiDesc',
            'FYPHDMarkForDeletion',
            'FYPHDUser',
            'FYPHDLastCreated',
            'FYPHDLastUpdated',
            'FYPHDDeletedAt'
        ];
        protected $casts = [
            'FYPHDLastCreated'      => 'datetime:d/m/Y',
            'FYPHDLastUpdated'      => 'datetime:d/m/Y',
            'FYPHDDeletedAt'        => 'datetime:d/m/Y'
        ];
}
