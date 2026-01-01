<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 'simpanan';

    protected $fillable = [
        'user_id',
        'jenis_transaksi',
        'jumlah',
        'keterangan',
        'status',
        'alasan_penolakan',
        'bukti_transaksi',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'approved_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
