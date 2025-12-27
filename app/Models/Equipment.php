<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_per_day',
        'stock',
        'image',
        'category'
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getAvailableStockAttribute()
    {
        $bookedCount = $this->bookings()
            ->whereIn('status', ['disetujui', 'berlangsung'])
            ->count();

        return $this->stock - $bookedCount;
    }
}
