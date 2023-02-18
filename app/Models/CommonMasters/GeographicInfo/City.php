<?php

namespace App\Models\CommonMasters\GeographicInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05901l05';
    protected $primaryKey = 'GMCTHUniqueId';
    protected $fillable = 
        [
            'GMCTHUniqueId',
            'GMCTHCityId',
            'GMCTHStateId',
            'GMCTHCountryId', 
            'GMCTHDesc1', 
            'GMCTHDesc2', 
            'GMCTHBiDesc', 
            'GMCTHMarkForDeletion',
            'GMCTHUser',
            'GMCTHLastCreated',
            'GMCTHLastUpdated',
            'GMCTHDeletedAt'
        ];
        protected $casts = [
            'GMCTHLastCreated' => 'datetime:d/m/Y',
            'GMCTHLastUpdated' => 'datetime:d/m/Y',
            'GMCTHDeletedAt' => 'datetime:d/m/Y'
        ];
}
