<?php

namespace App\Models\CommonMasters\BankingMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05902l04';
    protected $primaryKey = 'BMPMHUniqueId';
    protected $fillable = 
        [
            'BMPMHUniqueId',
            'BMPMHPaymentModeId', 
            'BMPMHDesc1', 
            'BMPMHDesc2', 
            'BMPMHBiDesc', 
            'BMPMHMarkForDeletion',
            'BMPMHUser',
            'BMPMHLastCreated',
            'BMPMHLastUpdated',
            'BMPMHDeletedAt'
        ];
        protected $casts = [
            'BMPMHLastCreated' => 'datetime:d/m/Y',
            'BMPMHLastUpdated' => 'datetime:d/m/Y',
            'BMPMHDeletedAt' => 'datetime:d/m/Y'
        ];
}
