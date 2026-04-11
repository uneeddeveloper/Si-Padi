<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanAdminController extends Controller
{
    /**
     * Menampilkan daftar semua pengaduan.
     */
    public function index(Request $request)
    {
        // Query dasar
        $query = Pengaduan::latest();

        // Filter berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Fitur Pencarian (Nama Pelapor, Judul, atau Nomor Tiket)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pelapor', 'like', "%$search%")
                    ->orWhere('judul', 'like', "%$search%")
                    ->orWhere('nomor_tiket', 'like', "%$search%");
            });
        }

        // Ambil data dengan pagination
        $pengaduans = $query->paginate(10)->withQueryString();

        return view('content-admin.content-pengaduan', compact('pengaduans'));
    }

    // detail pengaduan
    public function show($id) {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('content-admin.content-pengaduan-detail', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
            'komentar_petugas' => 'nullable|string'
        ]);

        // 2. Cari data pengaduan
        $pengaduan = Pengaduan::findOrFail($id);

        // 3. Update field
        $pengaduan->status = $request->status;

        // Jika request datang dari Form Detail (yang ada input komentar), simpan komentarnya
        if ($request->has('komentar_petugas')) {
            $pengaduan->komentar_petugas = $request->komentar_petugas;
        }

        $pengaduan->save();

        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Status Tiket #' . $pengaduan->nomor_tiket . ' berhasil diupdate menjadi ' . $request->status);
    }

    /**
     * Hapus Pengaduan (Hanya untuk Superadmin).
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')->with('success', 'Data pengaduan telah dihapus.');
    }
}