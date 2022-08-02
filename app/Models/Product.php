<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'short_description',
        'cat_status',
        'image',
        'reguler_price',
        'sale_price',
        'product_url',
        'product_status',
        'product_cat',
        'status' 
    ];
}
