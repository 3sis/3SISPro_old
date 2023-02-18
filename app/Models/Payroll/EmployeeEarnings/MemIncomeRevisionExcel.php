<?php

namespace App\Models\Payroll\EmployeeEarnings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemIncomeRevisionExcel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11121l0111';
    protected $primaryKey = 'EEIMDUniqueId';
    protected $fillable = 
        [
            'EEIMDUniqueId',
            'EEIMDCompId', 
            'EEIMDEmployeeId',
            'EEIMDEffectiveFrom',
            'EEIMDEffectiveTo',
            'EEIMDRevisedAmt',
            'EEIMDFixedOrPercent',
            'EEIMDSelect',
            'EEIMDUser',
            'EEIMDStatusId',
            'EEIMDLastCreated'
        ];
        protected $casts = [
            'EEIMDEffectiveFrom'    => 'datetime:d/m/Y',
            'EEIMDEffectiveTo'      => 'datetime:d/m/Y',
            'EEIMDLastCreated'      => 'datetime:d/m/Y'
        ];
}
