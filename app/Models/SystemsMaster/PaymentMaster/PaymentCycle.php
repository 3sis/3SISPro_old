<?php

namespace App\Models\SystemsMaster\PaymentMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCycle extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't00903l04';
    protected $primaryKey = 'PMPCHUniqueId';
    protected $fillable = 
        [
            'PMPCHUniqueId',
            'PMPCHCycleId', 
            'PMPCHDesc1'
        ];       
}
