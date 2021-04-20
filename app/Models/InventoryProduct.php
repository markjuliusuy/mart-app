<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'total_amount',
    ];
}
