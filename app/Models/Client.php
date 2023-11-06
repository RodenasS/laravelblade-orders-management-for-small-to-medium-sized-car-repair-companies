<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'email', 'phone', 'description'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tag', $filters['tag']);
        }

        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%'.$filters['search'].'%');
        }

        return $query;
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
