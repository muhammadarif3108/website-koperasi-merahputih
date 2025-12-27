<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'equipment_id',
        'booking_date',
        'return_date',
        'duration_days',
        'price_per_day',
        'total_price',
        'bukti_pembayaran',
        'status',
        'keterangan',
        'approved_at'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'return_date' => 'date',
        'price_per_day' => 'decimal:2',
        'total_price' => 'decimal:2',
        'approved_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}