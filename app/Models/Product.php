<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'brand_id',
        'category_id',
        'price',
        'reorder_level'
    ];

    protected $appends = [
      'stocks',
      'sales_name',
    ];

    protected $with = [
      'category'
    ];

    public function getStocksAttribute()
    {
        $sales_count = SaleProduct::where('product_id', $this->id)->sum('quantity');
        $inventory_count = InventoryProduct::where('product_id', $this->id)->sum('quantity');
        return $inventory_count - $sales_count;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getSalesNameAttribute()
    {
        return $this->code . ' - ' . $this->name . ' - ' . $this->stocks;
    }
}
