<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'user_id',
        'jenis_surat',
        'keperluan',
        'deskripsi',
        'status',
        'alasan_penolakan',
        'file_surat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
