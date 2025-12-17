<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 'simpanan';

    protected $fillable = [
        'user_id',
        'nominal',
        'bukti_transfer',
        'status',
        'keterangan',
        'approved_at'
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'approved_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
