<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class customers extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'opening_balance',
        'description',
        'address',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }



