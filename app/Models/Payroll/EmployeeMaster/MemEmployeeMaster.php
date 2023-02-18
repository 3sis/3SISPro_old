<?php

namespace App\Models\Payroll\EmployeeMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemEmployeeMaster extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zmem11101l01';
    protected $primaryKey = 'EMGIHUniqueId';
    protected $fillable = 
        [
            'EMGIHUniqueId',
            'EMGIHCompId',
            'EMGIHLocationId',
            'EMGIHEmployeeId',
            'EMGIHGenderId',
            'EMGIHSelect',
            'EMGIHFullName',
            'EMGIHDateOfJoining',
            'EMGIHEmploymentTypeId',
            'EMGIHDesignationId',
            'EMGIHDepartmentId',
            'EMGIHCalendarId',
            'EMGIHIsResignation',
            'EMGIHDateOfLeaving',
            'EMGIHLeaveWithoutPayIndicator',
            'EMGIHLeaveWithoutPayFrom',
            'EMGIHUser',
            'EMGIHLastCreated',
            'EMGIHLastUpdated',
            'EMGIHDeletedAt',

        ];
        protected $casts = [
            'EMGIHDateOfBirth'              => 'datetime:d/m/Y',
            'EMGIHDateOfJoining'            => 'datetime:d/m/Y',
            'EMGIHDateOfConfirmation'       => 'datetime:d/m/Y',
            'EMGIHLastCreated'              => 'datetime:d/m/Y',
            'EMGIHLastUpdated'              => 'datetime:d/m/Y',
            'EMGIHDeletedAt'                => 'datetime:d/m/Y'
        ];
}
