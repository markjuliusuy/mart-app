<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $appends = [
        'permissions',
    ];

    public function getPermissionsAttribute()
    {
        return [
            'edit' => auth()->user()->can('edit brands', $this),
            'delete' => auth()->user()->can('delete brands', $this),
        ];
    }
}
