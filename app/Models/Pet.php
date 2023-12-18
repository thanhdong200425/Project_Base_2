<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $table = 'pets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'thumbnail',
        'descr',
        'pet_category_id',
        'origin',
        'other_names',
        'classify',
        'fur_style',
        'fur_color',
        'weight',
        'longevity',
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['pet_id', 'created_at', 'updated_at'];
}
