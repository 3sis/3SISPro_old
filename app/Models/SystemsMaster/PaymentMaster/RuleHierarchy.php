<?php

namespace App\Models\SystemsMaster\PaymentMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleHierarchy extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't00903l02';
    protected $primaryKey = 'PMRHHUniqueId';
    protected $fillable = 
        [
            'FYPMHUniqueId',
            'PMRHHHierarchyId', 
            'PMRHHDesc1'
        ];       
}
