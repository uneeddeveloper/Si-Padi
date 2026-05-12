<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'pertanyaan' => 'Apa itu SiPadi?',
                'jawaban'    => 'SiPadi (Sistem Pengaduan Daring) adalah layanan pengaduan online untuk masyarakat agar dapat melaporkan permasalahan pelayanan publik.',
                'kategori'   => 'Umum',
                'urutan'     => 1,
            ],
            [
                'pertanyaan' => 'Bagaimana cara membuat laporan pengaduan?',
                'jawaban'    => 'Klik menu Pengaduan, isi formulir dengan benar (kategori, judul, deskripsi, foto, dan koordinat), lalu klik Kirim. Anda akan mendapatkan nomor tiket.',
                'kategori'   => 'Pengaduan',
                'urutan'     => 2,
            ],
            [
                'pertanyaan' => 'Apakah identitas pelapor dirahasiakan?',
                'jawaban'    => 'Ya. Data pribadi pelapor hanya diakses oleh petugas yang berwenang dan tidak dipublikasikan.',
                'kategori'   => 'Privasi',
                'urutan'     => 3,
            ],
            [
                'pertanyaan' => 'Berapa lama pengaduan akan ditindaklanjuti?',
                'jawaban'    => 'Pengaduan biasanya direspons dalam 1x24 jam hari kerja. Lama penyelesaian tergantung kategori dan kompleksitas masalah.',
                'kategori'   => 'Pengaduan',
                'urutan'     => 4,
            ],
            [
                'pertanyaan' => 'Bagaimana cara melacak status laporan saya?',
                'jawaban'    => 'Buka menu Lacak Pengaduan lalu masukkan nomor tiket yang Anda terima saat membuat laporan.',
                'kategori'   => 'Pengaduan',
                'urutan'     => 5,
            ],
        ];

        foreach ($data as $row) {
            Faq::updateOrCreate(
                ['pertanyaan' => $row['pertanyaan']],
                $row
            );
        }
    }
}
