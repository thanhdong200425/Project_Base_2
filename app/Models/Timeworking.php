<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeworking extends Model
{
    use HasFactory;
    protected $table = 'timeworkings';
    protected $primaryKey = 'timeworking_id';
    public $timestamps = false;
    protected $fillable = [
        'time_start',
        'time_end'
    ];
}
