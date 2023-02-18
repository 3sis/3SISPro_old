<?php

namespace App\Models\SystemsMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionElementIT extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T00906L01';
    protected $primaryKey = 'ITSEHUniqueId';
    protected $fillable = 
        [
            'ITSEHUniqueId',
            'ITSEHSectionElementId', 
            'ITSEHDesc1', 
            'ITSEHDesc2', 
            'ITSEHBiDesc',
            'ITSEHMarkForDeletion',
            'ITSEHUser',
            'ITSEHLastCreated',
            'ITSEHLastUpdated',
            'ITSEHDeletedAt'
        ];
        protected $casts = [
            'ITSEHLastCreated' => 'datetime:d/m/Y',
            'ITSEHLastUpdated' => 'datetime:d/m/Y',
            'ITSEHDeletedAt' => 'datetime:d/m/Y'
        ];
}
