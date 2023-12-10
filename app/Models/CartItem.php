<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_item',
        'item_quantity',
        'item_total_price',
        'id_cart',
        'id_product',
        'create_at',
        'updated_at',
    ];
}

