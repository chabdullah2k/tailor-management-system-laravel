<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeasurementValue extends Model
{
    protected $fillable = ['measurement_id', 'measurement_fields_id', 'fieldname', 'value'];


    public function measurement()
{
    return $this->belongsTo(Measurement::class);
}

    public function measurementField()
    {
        return $this->belongsTo(MeasurementField::class, 'measurement_fields_id');
    }
    public function order()
{
    return $this->belongsTo(Order::class);
}



}
