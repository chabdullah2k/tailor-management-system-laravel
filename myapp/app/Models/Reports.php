<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{

    
    public function customer()
    {
        return $this->belongsTo(customers::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
