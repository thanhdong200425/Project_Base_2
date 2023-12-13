<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'status',
        'decentralization_id'
    ];

    protected $hidden = ['password'];
}
