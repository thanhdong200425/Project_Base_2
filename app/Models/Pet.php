<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $primaryKey = 'pet_id';
    protected $fillable = [
        'name',
        'thumbnail',
        'description',
        'user_id',
        'pet_category_id',
        'origin',
        'other_names',
        'classify',
        'fur_style',
        'fur_color',
        'weight',
        'longevity'
    ];

    protected $hidden = ['pet_id', 'created_at', 'updated_at'];
}
