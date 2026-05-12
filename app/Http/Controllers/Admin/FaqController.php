<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query()->orderBy('urutan')->orderBy('id');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('pertanyaan', 'like', "%$s%")
                  ->orWhere('jawaban', 'like', "%$s%");
            });
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $faqs = $query->paginate(10)->withQueryString();
        $kategoriList = Faq::select('kategori')->distinct()->pluck('kategori');

        return view('content-admin.content-faq', compact('faqs', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $data = $this->validateInput($request);
        $data['is_active'] = $request->boolean('is_active', true);
        $faq = Faq::create($data);

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Tambah FAQ',
            'target'     => \Illuminate\Support\Str::limit($faq->pertanyaan, 50),
            'keterangan' => 'FAQ baru ditambahkan.',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $this->validateInput($request);
        $data['is_active'] = $request->boolean('is_active', true);
        $faq->update($data);

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Update FAQ',
            'target'     => \Illuminate\Support\Str::limit($faq->pertanyaan, 50),
            'keterangan' => 'FAQ diperbarui.',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $pertanyaan = \Illuminate\Support\Str::limit($faq->pertanyaan, 50);
        $faq->delete();

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Hapus FAQ',
            'target'     => $pertanyaan,
            'keterangan' => 'FAQ dihapus.',
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'FAQ berhasil dihapus.');
    }

    private function validateInput(Request $request): array
    {
        return $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban'    => ['required', 'string'],
            'kategori'   => ['required', 'string', 'max:50'],
            'urutan'     => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
