<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $primaryKey = 'service_id';
    protected $fillable = [
        'teamid',
        'name',
        'slug',
        'icon',
        'cost',
        'description'
    ];
}
