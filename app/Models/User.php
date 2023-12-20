<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'thumbnail',
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

    public function getAuthIdentifierName()
    {
        // Implementation goes here
    }

    public function getAuthIdentifier()
    {
        // Implementation goes here
    }

    public function getAuthPassword()
    {
        // Implementation goes here
    }

    public function getRememberToken()
    {
        // Implementation goes here
    }

    public function setRememberToken($value)
    {
        // Implementation goes here
    }

    public function getRememberTokenName()
    {
        // Implementation goes here
    }
}

