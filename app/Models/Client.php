<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_code', 'company_vat_code' , 'email', 'phone'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($query) use ($filters) {
                $query->orWhere('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('company_code', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('company_vat_code', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
            });
        }
    }

    public function vehicles() {
        return $this->hasMany(Vehicle::class);
    }

    // Define the relationship to Order
    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function getClientCodeAttribute(): string
    {
        return 'A' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }
}
