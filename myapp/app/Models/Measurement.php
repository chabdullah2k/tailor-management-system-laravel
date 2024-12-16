<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = ['customer_id', 'service_id', 'type_name', 'description'];

    public function customer()
    {
        return $this->belongsTo(customers::class);
    }


    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function measurementField()
    {
        return $this->belongsTo(MeasurementField::class);
    }

    public function measurementValues()
    {
        return $this->hasMany(MeasurementValue::class);
    }

    //     public function measurementField()
    // {
    //     return $this->belongsTo(MeasurementField::class, 'measurement_field_id');
    // }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
