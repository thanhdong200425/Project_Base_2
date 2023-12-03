<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert_Team extends Model
{
    use HasFactory;
    protected $table = 'expert_teams';
    protected $primaryKey = 'team_id';
    protected $fillable = [
        'name'
    ];

}
