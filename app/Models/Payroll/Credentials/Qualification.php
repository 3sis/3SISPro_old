<?php

namespace App\Models\Payroll\Credentials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11904L01';
    protected $primaryKey = 'CMQUHUniqueId';
    protected $fillable = 
        [
            'CMQUHUniqueId',
            'CMQUHDegreeId', 
            'CMQUHDesc1', 
            'CMQUHDesc2', 
            'CMQUHBiDesc', 
            'CMQUHMarkForDeletion',
            'CMQUHUser',
            'CMQUHLastCreated',
            'CMQUHLastUpdated',
            'CMQUHDeletedAt'
        ];
        protected $casts = [
            'CMQUHLastCreated' => 'datetime:d/m/Y',
            'CMQUHLastUpdated' => 'datetime:d/m/Y',
            'CMQUHDeletedAt' => 'datetime:d/m/Y'
        ];
}
