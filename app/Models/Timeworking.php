<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeworking extends Model
{
    use HasFactory;
    protected $table = 'timeworking';
    protected $primaryKey = 'id';
    protected $fillable = [
        'timeworking'
    ];

    public $timestamps = false;
}
