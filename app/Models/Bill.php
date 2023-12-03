<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $primaryKey = 'bill_id';
    protected $fillable = [
        'user_id',
        'payment_method',
        'total_price',
        'created_at',
        'status',
        'updated_at'
    ];

    
}
