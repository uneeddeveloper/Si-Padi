<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        $query = Instansi::query()->latest('id');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama', 'like', "%$s%")
                  ->orWhere('kode', 'like', "%$s%")
                  ->orWhere('penanggung_jawab', 'like', "%$s%");
            });
        }

        $instansis = $query->paginate(10)->withQueryString();

        return view('content-admin.content-instansi', compact('instansis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'             => ['required', 'string', 'max:150'],
            'kode'             => ['required', 'string', 'max:20', 'unique:instansis,kode'],
            'penanggung_jawab' => ['nullable', 'string', 'max:100'],
            'email'            => ['nullable', 'email', 'max:100'],
            'nomor_telepon'    => ['nullable', 'string', 'max:20'],
            'alamat'           => ['nullable', 'string', 'max:255'],
            'deskripsi'        => ['nullable', 'string'],
            'is_active'        => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['kode'] = strtoupper($data['kode']);

        $instansi = Instansi::create($data);

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Tambah Instansi',
            'target'     => $instansi->nama,
            'keterangan' => 'Menambah instansi baru: ' . $instansi->kode,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', "Instansi {$instansi->nama} berhasil ditambahkan.");
    }

    public function update(Request $request, Instansi $instansi)
    {
        $data = $request->validate([
            'nama'             => ['required', 'string', 'max:150'],
            'kode'             => ['required', 'string', 'max:20', 'unique:instansis,kode,' . $instansi->id],
            'penanggung_jawab' => ['nullable', 'string', 'max:100'],
            'email'            => ['nullable', 'email', 'max:100'],
            'nomor_telepon'    => ['nullable', 'string', 'max:20'],
            'alamat'           => ['nullable', 'string', 'max:255'],
            'deskripsi'        => ['nullable', 'string'],
            'is_active'        => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['kode'] = strtoupper($data['kode']);

        $instansi->update($data);

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Update Instansi',
            'target'     => $instansi->nama,
            'keterangan' => 'Memperbarui data instansi ' . $instansi->kode,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', "Instansi {$instansi->nama} berhasil diperbarui.");
    }

    public function destroy(Instansi $instansi)
    {
        $nama = $instansi->nama;
        $instansi->delete();

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Hapus Instansi',
            'target'     => $nama,
            'keterangan' => 'Instansi dihapus.',
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', "Instansi {$nama} berhasil dihapus.");
    }
}
