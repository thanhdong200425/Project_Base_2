<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_Position extends Model
{
    use HasFactory;
    protected $table = 'staff_position';
    protected $primaryKey = 'position_id';
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

}
