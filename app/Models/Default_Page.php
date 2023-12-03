<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Default_Page extends Model
{
    use HasFactory;
    protected $table = 'default_pages';
    protected $primaryKey = 'defaul_page_id';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id'
    ];
}
