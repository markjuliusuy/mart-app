<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_id_number',
        'customer_contact_number',
        'customer_is_pwd_sc',
        'discount_id',
        'discount_name',
        'discount',
        'discount_amount',
        'total_discount',
        'total_price',
        'total_quantity',
        'subtotal_amount',
        'subtotal_amount_no_vat',
        'total_amount',
        'tendered_amount',
        'change_amount',
        'grand_total',
        'notes',
        'transaction_type',
        'user_id'
    ];
    protected $with = [
        'products'
    ];


    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
    public function getUpdatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }

    public function products()
    {
        return $this->hasMany(SaleProduct::class, 'sale_id');
    }
}
