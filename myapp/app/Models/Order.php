<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'customer_id',
        'user_id',
        'service_id',
        'total_price',
        'order_date',
        'delivery_date',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(customers::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    // public function measurements()
    // {
    //     return $this->hasMany(Measurement::class);
    // }
    public function measurements()
{
    return $this->hasMany(Measurement::class);
}

}
