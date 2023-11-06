<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'date',
        'status',
        'estimated_start',
        'estimated_end',
        'client_id',
        'vehicle_id',
        'special_conditions',
        'total_ex_vat',
        'vat',
        'total_inc_vat',
    ];

    public function scopeFilter($query, array $filters)
    {

        if ($filters['search'] ?? false) {
            $query->where('order_number', 'like', '%' . request('search') . '%')
                ->orWhere('date', 'like', '%' . request('search') . '%')
                ->orWhere('client_id', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
