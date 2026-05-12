<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansis';

    protected $fillable = [
        'nama',
        'kode',
        'penanggung_jawab',
        'email',
        'nomor_telepon',
        'alamat',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
