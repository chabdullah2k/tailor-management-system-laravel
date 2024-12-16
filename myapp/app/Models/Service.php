<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model
{
    use SoftDeletes;
    protected $fillable = ['code', 'name', 'price', 'description', 'active'];


public function measurements()
{
    return $this->hasMany(Measurement::class);
}

}
