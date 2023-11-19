<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'status',
        'estimated_start',
        'estimated_end',
        'client_id',
        'vehicle_id',
        'user_id',
        'vehicle_mileage',
        'total_ex_vat',
        'vat',
        'total_inc_vat',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {
            $order->order_number = 'U' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
            $order->save(); // Save the order again with the order_number
        });
    }

    public function scopeFilter($query, array $filters)
    {

        if ($filters['search'] ?? false) {
            $query->where('order_number', 'like', '%' . request('search') . '%')
                ->orWhere('date', 'like', '%' . request('search') . '%')
                ->orWhere('client_id', 'like', '%' . request('search') . '%');
        }
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function images()
    {
        return $this->hasMany(OrderImage::class);
    }

}
