<?php

namespace App\Models\Payroll\Credentials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11904L03';
    protected $primaryKey = 'CMSKHUniqueId';
    protected $fillable = 
        [
            'CMSKHUniqueId',
            'CMSKHSkillId', 
            'CMSKHDesc1', 
            'CMSKHDesc2', 
            'CMSKHBiDesc', 
            'CMSKHMarkForDeletion',
            'CMSKHUser',
            'CMSKHLastCreated',
            'CMSKHLastUpdated',
            'CMSKHDeletedAt'
        ];
        protected $casts = [
            'CMSKHLastCreated' => 'datetime:d/m/Y',
            'CMSKHLastUpdated' => 'datetime:d/m/Y',
            'CMSKHDeletedAt' => 'datetime:d/m/Y'
        ];
}
