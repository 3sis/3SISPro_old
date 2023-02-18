<?php

namespace App\Models\SystemsMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoundingStrategy extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T00905L01';
    protected $primaryKey = 'RSRSHUniqueId';
    protected $fillable = 
        [
            'RSRSHUniqueId',
            'RSRSHRoundingId', 
            'RSRSHDesc1', 
        ];
}
