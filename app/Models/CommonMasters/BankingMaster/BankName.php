<?php

namespace App\Models\CommonMasters\BankingMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankName extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05902l01';
    protected $primaryKey = 'BMBNHUniqueId';
    protected $fillable = 
        [
            'BMBNHUniqueId',
            'BMBNHBankId', 
            'BMBNHDesc1', 
            'BMBNHDesc2', 
            'BMBNHBiDesc', 
            'BMBNHMarkForDeletion',
            'BMBNHUser',
            'BMBNHLastCreated',
            'BMBNHLastUpdated',
            'BMBNHDeletedAt'
        ];
        protected $casts = [
            'BMBNHLastCreated' => 'datetime:d/m/Y',
            'BMBNHLastUpdated' => 'datetime:d/m/Y',
            'BMBNHDeletedAt' => 'datetime:d/m/Y'
        ];
}
