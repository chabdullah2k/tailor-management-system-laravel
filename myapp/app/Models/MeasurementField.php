<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementField extends Model
{
    use HasFactory;

    protected $fillable = ['fieldname', 'order', 'type', 'service_id', 'description', 'is_required'];

    public function measurementValues()
    {
        return $this->hasMany(MeasurementValue::class, 'measurement_fields_id');
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class, 'measurement_field_id');
    }

}
