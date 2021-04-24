<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'contact_number',
        'address',
        'date_of_birth',
    ];

    protected $appends = [
        'name',
        'permissions'
    ];

    public function getPermissionsAttribute()
    {
        return [
            'edit' => auth()->user()->can('edit customers', $this),
            'delete' => auth()->user()->can('delete customers', $this),
        ];
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
