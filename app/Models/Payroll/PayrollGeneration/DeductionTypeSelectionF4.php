<?php

namespace App\Models\Payroll\PayrollGeneration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionTypeSelectionF4 extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mem11906l02';
    protected $primaryKey = 'PMDAHUniqueId';
    protected $fillable = 
        [
            'PMDAHUniqueId',
            'PMDAHDeductionId', 
            'PMDAHDesc1', 
            'PMDAHSelect',
            'PMDAHUser',
            'PMDAHLastCreated'
        ];
        protected $casts = [
            'PMDAHLastCreated'      => 'datetime:d/m/Y'
        ];
}
