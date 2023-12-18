<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decentralization extends Model
{
    use HasFactory;
    protected $table = 'decentralization';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'permission',
        'created_at',
        'updated_at'
    ];
}
