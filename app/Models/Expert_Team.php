<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert_Team extends Model
{
    use HasFactory;
    protected $table = 'expert_team';
    protected $primaryKey = 'id';
    protected $fillable = [
        'postionid',
        'name',
        'gender',
        'dob',
        'phone',
        'email',
        'avatar',
        'about',
        'experience',
        'pinterest',
        'facebook',
        'twitter',
        'tiktok',
        'created_at',
        'updated_at'
    ];
}
