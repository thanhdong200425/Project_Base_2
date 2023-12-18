<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login_Token extends Model
{
    use HasFactory;
    protected $table = 'login_token';
    protected $primaryKey = 'id';

    protected $fillable = [
        'token',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
