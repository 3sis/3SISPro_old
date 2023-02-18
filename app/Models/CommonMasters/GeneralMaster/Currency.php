<?php

namespace App\Models\CommonMasters\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05901l07';
    protected $primaryKey = 'GMCRHUniqueId';
    protected $fillable = 
        [
            'GMCRHUniqueId',
            'GMCRHCurrencyId ', 
            'GMCRHDesc1', 
            'GMCRHDesc2', 
            'GMCRHBiDesc', 
            'GMCRHMarkForDeletion',
            'GMCRHUser',
            'GMCRHLastCreated',
            'GMCRHLastUpdated',
            'GMCRHDeletedAt'
        ];
        protected $casts = [
            'GMCRHLastCreated' => 'datetime:d/m/Y',
            'GMCRHLastUpdated' => 'datetime:d/m/Y',
            'GMCRHDeletedAt' => 'datetime:d/m/Y'
        ];
}
