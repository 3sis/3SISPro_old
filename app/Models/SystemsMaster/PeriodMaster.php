<?php

namespace App\Models\SystemsMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodMaster extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't00901L01';
    protected $primaryKey = 'FYPMHUniqueId';
    protected $fillable = 
        [
            'FYPMHUniqueId',
            'FYPMHPeriodId', 
            'FYPMHDesc1', 
            'FYPMHDesc2', 
            'FYPMHNMonth', 
            'FYPMHNAddInt', 
            'FYPMHBiDesc', 
            'FYPMHMarkForDeletion',
            'FYPMHUser',
            'FYPMHLastCreated',
            'FYPMHLastUpdated',
            'FYPMHDeletedAt'
        ];
        protected $casts = [
            'FYPMHLastCreated' => 'datetime:d/m/Y',
            'FYPMHLastUpdated' => 'datetime:d/m/Y',
            'FYPMHDeletedAt' => 'datetime:d/m/Y'
        ];
}
