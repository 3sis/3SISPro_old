<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeTypeSalarySlashF4 extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mem11906L0101';
    protected $primaryKey = 'PMSSHUniqueId';
    protected $fillable = 
        [
            'PMSSHUniqueId',
            'PMSSHIncomeId', 
            'PMSSHDesc1', 
            'PMSSHSelect',
            'PMSSHUser',
            'PMSSHLastCreated'
        ];
        protected $casts = [
            'PMSSHLastCreated'      => 'datetime:d/m/Y'
        ];
}
