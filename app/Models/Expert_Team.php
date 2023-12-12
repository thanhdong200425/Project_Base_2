<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert_Team extends Model
{
    use HasFactory;
    protected $table = 'expert_teams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'team_id',
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
