<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'nomor_tiket',
        'kategori',
        'nama_pelapor',
        'nomor_hp',
        'rt_rw',
        'urgensi',
        'judul',
        'status',
        'komentar_petugas',
        'deskripsi',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
