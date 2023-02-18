<?php

namespace App\Models\CommonMasters\FiscalYear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicHolidayHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05903l04';
    protected $primaryKey = 'FYPHHUniqueId';
    protected $fillable = 
        [
            'FYPHHUniqueId',
            'FYPHHCalendarId',
            'FYPHHFiscalYearId',
            'FYPHHMarkForDeletion',
            'FYPHHUser',
            'FYPHHLastCreated',
            'FYPHHLastUpdated',
            'FYPHHDeletedAt'
        ];
        protected $casts = [
            'FYPHHLastCreated'      => 'datetime:d/m/Y',
            'FYPHHLastUpdated'      => 'datetime:d/m/Y',
            'FYPHHDeletedAt'        => 'datetime:d/m/Y'
        ];
}
// class PublicHolidayDetail extends Model {

// }
