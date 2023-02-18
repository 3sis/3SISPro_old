<?php

namespace App\Models\SystemsMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiColumnHead extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T00904L01';
    protected $primaryKey = 'BICHHUniqueId';
    protected $fillable = 
        [
            'BICHHUniqueId',
            'BICHHSystemCode', 
            'BICHHSystemDesc1', 
            'BICHHGroupId', 
            'BICHHBiGroupDesc', 
            'BICHHElementId', 
            'BICHHBiElementDesc', 
            'BICHHMarkForDeletion',
            'BICHHUser',
            'BICHHLastCreated',
            'BICHHLastUpdated',
            'BICHHDeletedAt'
        ];
        protected $casts = [
            'BICHHLastCreated' => 'datetime:d/m/Y',
            'BICHHLastUpdated' => 'datetime:d/m/Y',
            'BICHHDeletedAt' => 'datetime:d/m/Y'
        ];
}
