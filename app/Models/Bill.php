<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bill';
    protected $primaryKey = 'billid';
    protected $fillable = [
        'userid',
        'payment_method',
        'total_price',
        'status',
        'updated_at',
        'created_at',
    ];


}
