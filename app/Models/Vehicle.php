<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'brand',
        'model',
        'mileage',
        'first_registration',
        'license_plate',
        'vin',
        'created_at',
        'description',
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($query) use ($filters) {
                $query->orWhere('brand', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('model', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('license_plate', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('vin', 'like', '%' . $filters['search'] . '%');
            });
        }
    }

    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
