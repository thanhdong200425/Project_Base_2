<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotion';
    protected $primaryKey = 'promotionid';
    protected $fillable = [
        'promotion_name',
        'promotion_type',
        'promotion_value',
        'promotion_status',
        'time_start'
    ];

    public $timestamps = false;
}
