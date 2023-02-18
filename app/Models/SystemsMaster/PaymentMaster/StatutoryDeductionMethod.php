<?php

namespace App\Models\SystemsMaster\PaymentMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutoryDeductionMethod extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T00903L05';
    protected $primaryKey = 'PMDMHUniqueId';
    protected $fillable = 
        [
            'PMDMHUniqueId',
            'PMDMHMethodId', 
            'PMDMHDesc'
        ];   
}
