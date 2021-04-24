<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
            'edit' => auth()->user()->can('edit categories', $this),
            'delete' => auth()->user()->can('delete categories', $this),
        ];
    }
}
