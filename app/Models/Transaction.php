<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'status',
        'order_total_price',
        'id_cart',
        'id_user',
        'created_at',
        'updated_at',
    ];
}
