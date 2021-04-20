<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InventoryProduct;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
      'supplier_id',
      'supplier_company_name',
      'supplier_name',
      'supplier_address',
      'supplier_contact_number',
      'total_quantity',
      'total_price',
      'total_amount',
      'user_id',
    ];

    public function products()
    {
        return $this->hasMany(InventoryProduct::class);
    }
    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
    public function getUpdatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
}
