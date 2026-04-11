@extends('layout-admin.main-layout-admin')

@section('title', 'Detail Pengaduan #' . $pengaduan->nomor_tiket)

@section('content')
    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.pengaduan') }}"
                class="inline-flex items-center gap-2 text-xs font-bold text-primary mb-2 hover:underline">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
            <h1 class="text-2xl font-grotesk font-bold text-gray-800">Tiket #{{ $pengaduan->nomor_tiket }}</h1>
        </div>
        <div class="flex items-center gap-2">
            <span
                class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                            {{ $pengaduan->status == 'Menunggu' ? 'bg-red-100 text-red-600' : ($pengaduan->status == 'Diproses' ? 'bg-amber-100 text-amber-600' : ($pengaduan->status == 'Selesai' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600')) }}">
                Status: {{ $pengaduan->status }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 text-sm">
        {{-- KIRI: Konten Pengaduan --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Kartu Utama Deskripsi --}}
            <div class="bg-white rounded-radius border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700 uppercase text-xs tracking-widest">Detail Laporan</h3>
                    <span class="text-[10px] text-gray-400 italic">Dilaporkan pada:
                        {{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $pengaduan->judul }}</h2>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span
                                class="px-2 py-1 bg-primary-light text-primary rounded-lg text-[10px] font-bold uppercase">
                                <i class="bi bi-tag-fill mr-1"></i> {{ $pengaduan->kategori }}
                            </span>
                            <span
                                class="px-2 py-1 rounded-lg text-[10px] font-bold uppercase 
                                            {{ $pengaduan->urgensi == 'Tinggi' ? 'bg-red-50 text-red-600' : ($pengaduan->urgensi == 'Sedang' ? 'bg-amber-50 text-amber-600' : 'bg-blue-50 text-blue-600') }}">
                                <i class="bi bi-exclamation-triangle-fill mr-1"></i> Urgensi: {{ $pengaduan->urgensi }}
                            </span>
                        </div>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $pengaduan->deskripsi }}</p>
                    </div>

                    {{-- Lampiran Foto --}}
                    @if($pengaduan->foto)
                        <div>
                            <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                                <i class="bi bi-images text-primary"></i> Lampiran Foto
                            </h4>
                            <div
                                class="relative group w-full sm:w-80 h-48 rounded-xl overflow-hidden border-2 border-gray-100 shadow-sm">
                                <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                                    class="w-full h-full object-cover transition-transform group-hover:scale-105"
                                    alt="Foto Pengaduan">
                                <a href="{{ asset('storage/' . $pengaduan->foto) }}" target="_blank"
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                                    <i class="bi bi-zoom-in text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kartu Data Pelapor --}}
            <div class="bg-white rounded-radius border border-gray-200 shadow-sm p-6 grid grid-cols-2 sm:grid-cols-3 gap-6">
                <div class="col-span-full border-b pb-2 mb-2">
                    <h3 class="font-bold text-gray-700 uppercase text-[10px] tracking-widest">Informasi Identitas Pelapor
                    </h3>
                </div>
                <div>
                    <label class="block text-[10px] text-gray-400 font-bold uppercase">Nama Lengkap</label>
                    <p class="font-bold text-gray-800">{{ $pengaduan->nama_pelapor }}</p>
                </div>
                <div>
                    <label class="block text-[10px] text-gray-400 font-bold uppercase">Nomor HP/WhatsApp</label>
                    <p class="font-bold text-gray-800">{{ $pengaduan->nomor_hp }}</p>
                </div>
                <div>
                    <label class="block text-[10px] text-gray-400 font-bold uppercase">RT / RW</label>
                    <p class="font-bold text-gray-800">{{ $pengaduan->rt_rw }}</p>
                </div>
            </div>
        </div>

        {{-- KANAN: Aksi Administrasi --}}
        <div class="space-y-6">
            {{-- Update Status Form --}}
            <div class="bg-white rounded-radius border border-gray-200 shadow-sm p-6">
                <h3 class="font-bold text-gray-700 mb-4 flex items-center gap-2 text-xs uppercase tracking-wider">
                    <i class="bi bi-gear-fill text-primary"></i> Tindak Lanjut Petugas
                </h3>

                <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id) }}" method="POST" class="space-y-4">
                    @csrf @method('PATCH')

                    <div>
                        <label class="text-[11px] font-bold text-gray-500 block mb-1">Status Laporan</label>
                        <select name="status"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary-light outline-none transition-all">
                            <option value="Menunggu" {{ $pengaduan->status == 'Menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ $pengaduan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[11px] font-bold text-gray-500 block mb-1">Komentar / Balasan Petugas</label>
                        <textarea name="komentar_petugas" rows="4"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary-light outline-none transition-all resize-none"
                            placeholder="Tuliskan progres atau tanggapan resmi...">{{ $pengaduan->komentar_petugas }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark shadow-md shadow-primary/10 transition-all">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            {{-- Kartu Bantuan --}}
            <div
                class="p-5 bg-gradient-to-br from-primary to-primary-dark rounded-radius text-white relative overflow-hidden group">
                <i
                    class="bi bi-info-circle absolute -right-4 -top-4 text-7xl opacity-10 group-hover:rotate-12 transition-transform duration-500"></i>
                <h4 class="font-bold text-sm mb-2 relative z-10">Pemberitahuan Otomatis</h4>
                <p class="text-[11px] text-white/80 leading-relaxed relative z-10">
                    Setiap perubahan status dan penambahan komentar akan segera diketahui oleh pelapor melalui sistem
                    aplikasi user. Pastikan bahasa yang digunakan sopan dan informatif.
                </p>
            </div>
        </div>
    </div>
@endsection