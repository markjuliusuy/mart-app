<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'type',
    ];

    protected $appends = [
        'permissions'
    ];

    public function getPermissionsAttribute()
    {
        return [
            'edit' => auth()->user()->can('edit discounts', $this),
            'delete' => auth()->user()->can('delete discounts', $this),
        ];
    }
}
