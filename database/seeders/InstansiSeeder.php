<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
                'kode' => 'DPUPR',
                'penanggung_jawab' => 'Kepala Dinas PUPR',
                'email' => 'pupr@sipadi.test',
                'nomor_telepon' => '021-1111001',
                'alamat' => 'Jl. Pemuda No. 1',
                'deskripsi' => 'Menangani pengaduan kategori Infrastruktur.',
            ],
            [
                'nama' => 'Dinas Lingkungan Hidup',
                'kode' => 'DLH',
                'penanggung_jawab' => 'Kepala DLH',
                'email' => 'dlh@sipadi.test',
                'nomor_telepon' => '021-1111002',
                'alamat' => 'Jl. Melati No. 2',
                'deskripsi' => 'Menangani pengaduan kategori Kebersihan & Lingkungan.',
            ],
            [
                'nama' => 'Satuan Polisi Pamong Praja',
                'kode' => 'SATPOLPP',
                'penanggung_jawab' => 'Kepala Satpol PP',
                'email' => 'satpolpp@sipadi.test',
                'nomor_telepon' => '021-1111003',
                'alamat' => 'Jl. Kenanga No. 3',
                'deskripsi' => 'Menangani pengaduan kategori Keamanan & Ketertiban.',
            ],
            [
                'nama' => 'Dinas Kependudukan dan Pencatatan Sipil',
                'kode' => 'DUKCAPIL',
                'penanggung_jawab' => 'Kepala Dukcapil',
                'email' => 'dukcapil@sipadi.test',
                'nomor_telepon' => '021-1111004',
                'alamat' => 'Jl. Mawar No. 4',
                'deskripsi' => 'Menangani pengaduan kategori Administrasi.',
            ],
            [
                'nama' => 'Dinas Sosial',
                'kode' => 'DINSOS',
                'penanggung_jawab' => 'Kepala Dinas Sosial',
                'email' => 'dinsos@sipadi.test',
                'nomor_telepon' => '021-1111005',
                'alamat' => 'Jl. Anggrek No. 5',
                'deskripsi' => 'Menangani pengaduan kategori Sosial.',
            ],
        ];

        foreach ($data as $row) {
            Instansi::updateOrCreate(['kode' => $row['kode']], $row);
        }
    }
}
