<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_code',
        'product_name',
        'quantity',
        'unit',
        'unit_price',
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($query) use ($filters) {
                $query->orWhere('product_code', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('product_name', 'like', '%' . $filters['search'] . '%');
            });
        }
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
