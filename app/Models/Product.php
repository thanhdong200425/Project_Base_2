<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'price',
        'quantity',
        'thumbnail1',
        'thumbnail2',
        'thumbnail3',
        'promotion_id',
        'dimension',
        'color',
        'evaluate_star',
        'evaluate_count',
        'description',
        'status'
    ];
}
