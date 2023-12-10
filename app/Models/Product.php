<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_product';
    protected $fillable = [
        'name',
        'description',
        'imgUrl',
        'stock',
        'price',
        'id_user',
        'created_at',
        'updated_at'
    ];

}