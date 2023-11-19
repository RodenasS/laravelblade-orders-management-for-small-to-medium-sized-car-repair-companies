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

    // Relationship to Client
    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Relationship to Orders
    public function orders() {
        return $this->hasMany(Order::class);
    }
}
