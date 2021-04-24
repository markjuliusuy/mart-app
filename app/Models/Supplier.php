<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'name',
        'contact_person',
        'contact_number',
        'email',
        'address',
    ];

    protected $appends = [
        'permissions'
    ];

    public function getPermissionsAttribute()
    {
        return [
            'edit' => auth()->user()->can('edit suppliers', $this),
            'delete' => auth()->user()->can('delete suppliers', $this),
        ];
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
