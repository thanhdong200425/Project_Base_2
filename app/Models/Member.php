<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $primaryKey = 'member_id';
    protected $fillable = [
        'position_id',
        'name',
        'gender',
        'dob',
        'phone',
        'email',
        'avatar',
        'description',
        'pinterest',
        'facebook',
        'twitter',
        'tiktok',
    ];
}
