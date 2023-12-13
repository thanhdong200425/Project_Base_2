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
        'phone',
        'address',
        'dob',
        'contact_facebook',
        'contact_twitter',
        'contact_linkedin',
        'contact_pinterest',
        'about_content'
    ];

    protected $hidden = ['password', 'created_at', 'updated_at'];
}
