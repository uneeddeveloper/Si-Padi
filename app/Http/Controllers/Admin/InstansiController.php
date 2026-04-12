<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstansiController extends Controller
{
    public function index()
    {
        $instansis = Instansi::latest()->get();
        return view('content-admin.content-instansi', compact('instansis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'bidang' => 'required|string|max:100',
            'kontak' => 'nullable|string|max:50',
            'email'  => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
        ], [
            'nama.required'   => 'Nama instansi wajib diisi.',
            'bidang.required' => 'Bidang instansi wajib diisi.',
        ]);

        $instansi = Instansi::create($request->only('nama', 'bidang', 'kontak', 'email', 'alamat'));

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Tambah Instansi',
            'target'     => $instansi->nama,
            'keterangan' => 'Instansi baru ditambahkan: ' . $instansi->nama,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Instansi ' . $instansi->nama . ' berhasil ditambahkan.');
    }

    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'bidang' => 'required|string|max:100',
            'kontak' => 'nullable|string|max:50',
            'email'  => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
        ]);

        $instansi->update($request->only('nama', 'bidang', 'kontak', 'email', 'alamat'));

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Edit Instansi',
            'target'     => $instansi->nama,
            'keterangan' => 'Data instansi ' . $instansi->nama . ' diperbarui.',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Data instansi berhasil diperbarui.');
    }

    public function destroy(Request $request, Instansi $instansi)
    {
        $nama = $instansi->nama;
        $instansi->delete();

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Hapus Instansi',
            'target'     => $nama,
            'keterangan' => 'Instansi ' . $nama . ' dihapus dari sistem.',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Instansi ' . $nama . ' berhasil dihapus.');
    }
}
