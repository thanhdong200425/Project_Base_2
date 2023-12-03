<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decentralization extends Model
{
    use HasFactory;
    protected $primaryKey = 'decentralization_id';
    protected $fillable = [
        'decentralization_name',
    ];
}
