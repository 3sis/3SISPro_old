<?php

namespace App\Models\Payroll\Credentials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11904L02';
    protected $primaryKey = 'CMCTHUniqueId';
    protected $fillable = 
        [
            'CMCTHUniqueId',
            'CMCTHCertificateId', 
            'CMCTHDesc1', 
            'CMCTHDesc2', 
            'CMCTHBiDesc', 
            'CMCTHMarkForDeletion',
            'CMCTHUser',
            'CMCTHLastCreated',
            'CMCTHLastUpdated',
            'CMCTHDeletedAt'
        ];
        protected $casts = [
            'CMCTHLastCreated' => 'datetime:d/m/Y',
            'CMCTHLastUpdated' => 'datetime:d/m/Y',
            'CMCTHDeletedAt' => 'datetime:d/m/Y'
        ];
}
