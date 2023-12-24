<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'productid';
    protected $fillable = [
        'product_name',
        'slug',
        'price',
        'quantity',
        'thumpnail2',
        'promotionid',
        'dimensions',
        'color',
        'evaluate_star',
        'evaluate_quantity',
        'description',
        'product_status',
        'ingredient',
        'origin',
        'created_at',
        'updated_at'
    ];
}
