<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $fillable = [
        'teamid',
        'name',
        'slug',
        'icon',
        'cost',
        'descr',
        'created_at',
        'updated_at'
    ];
}
