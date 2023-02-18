<?php

namespace App\Models\CommonMasters\GeographicInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05901l06';
    protected $primaryKey = 'GMLMHUniqueId';
    protected $fillable = 
        [
            'GMLMHUniqueId',
            'GMLMHCompanyId',
            'GMLMHLocationId',
            'GMLMHCityId',
            'GMLMHStateId',
            'GMLMHCountryId', 
            'GMLMHDesc1', 
            'GMLMHDesc2', 
            'GMLMHBiDesc', 
            'GMLMHMarkForDeletion',
            'GMLMHUser',
            'GMLMHLastCreated',
            'GMLMHLastUpdated',
            'GMLMHDeletedAt'
        ];
        protected $casts = [
            'GMLMHLastCreated' => 'datetime:d/m/Y',
            'GMLMHLastUpdated' => 'datetime:d/m/Y',
            'GMLMHDeletedAt' => 'datetime:d/m/Y'
        ];
}
