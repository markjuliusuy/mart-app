<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    protected $fillable = [
      'sale_id',
      'product_id',
      'product_name',
      'price',
      'discount_price',
      'quantity',
      'discount',
      'discount_amount',
      'discount_type',
      'total_amount',
      'total_amount_no_discount',
    ];
}
