@extends('layout-admin.main-layout-admin')

@section('title', 'Manajemen FAQ')

@section('content')

    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">Dashboard</a>
                <i class="bi bi-chevron-right text-[10px]"></i>
                <span class="text-gray-400">FAQ</span>
            </div>
            <h1 class="font-grotesk text-2xl font-bold text-gray-800 tracking-tight">Manajemen FAQ</h1>
            <p class="text-sm text-gray-500 mt-1">Pertanyaan dan jawaban yang sering ditanyakan masyarakat.</p>
        </div>
        <button onclick="openModal()"
            class="px-4 py-2 bg-primary text-white rounded-lg text-xs font-bold hover:bg-primary-dark flex items-center gap-2 shadow-sm shadow-primary/20">
            <i class="bi bi-plus-lg"></i> Tambah FAQ
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm flex items-center gap-2">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <form method="GET" class="mb-4 flex gap-2 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pertanyaan atau jawaban..."
            class="flex-1 max-w-md px-4 py-2 bg-white border border-[#e2e8f0] rounded-lg text-sm focus:border-primary outline-none">
        <select name="kategori" class="px-4 py-2 bg-white border border-[#e2e8f0] rounded-lg text-sm focus:border-primary outline-none">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $k)<option value="{{ $k }}" {{ request('kategori')===$k?'selected':'' }}>{{ $k }}</option>@endforeach
        </select>
        <button type="submit" class="px-4 py-2 bg-white border border-[#e2e8f0] rounded-lg text-xs font-bold hover:bg-bg-base">Filter</button>
    </form>

    <div class="bg-white rounded-radius border border-[#e2e8f0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50/50 border-b border-[#e2e8f0]">
            <h3 class="font-bold text-sm text-gray-700 flex items-center gap-2">
                <i class="bi bi-question-circle-fill text-primary"></i> Daftar FAQ ({{ $faqs->total() }})
            </h3>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($faqs as $f)
                <div class="px-6 py-4 hover:bg-bg-base/30">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-primary-light text-primary flex items-center justify-center font-bold text-xs shrink-0">
                            #{{ $f->urutan }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 bg-amber-50 text-amber-700 text-[10px] font-bold rounded uppercase">{{ $f->kategori }}</span>
                                @if($f->is_active)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-green-50 text-green-600 text-[10px] font-bold uppercase">Aktif</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-gray-100 text-gray-500 text-[10px] font-bold uppercase">Nonaktif</span>
                                @endif
                            </div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $f->pertanyaan }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-2">{{ $f->jawaban }}</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <button type="button" onclick='openEditModal(@json($f))' title="Edit"
                                class="w-8 h-8 flex items-center justify-center border border-gray-200 rounded-lg text-gray-400 hover:text-primary hover:bg-primary-light hover:border-primary-light">
                                <i class="bi bi-pencil"></i>
                            </button>
                            @if(Auth::user()->role === 'superadmin')
                                <form action="{{ route('admin.faq.destroy', $f) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center border border-gray-200 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 hover:border-red-200">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-gray-400 text-sm">Belum ada FAQ.</div>
            @endforelse
        </div>
        @if($faqs->hasPages())
            <div class="px-6 py-3 border-t border-gray-100">{{ $faqs->links() }}</div>
        @endif
    </div>

    {{-- Modal --}}
    <div id="modal-faq" class="hidden fixed inset-0 bg-black/50 z-[1100] overflow-y-auto">
        <div class="flex items-start justify-center min-h-full p-4 py-10">
            <div class="bg-white rounded-radius shadow-2xl w-full max-w-xl">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="bi bi-question-circle text-primary"></i> <span id="modal-title">Tambah FAQ</span>
                    </h3>
                    <button onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <form id="form-faq" action="{{ route('admin.faq.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <input type="hidden" name="_method" id="form-method" value="POST">

                    @if($errors->any())
                        <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-xs text-red-600">
                            <ul class="space-y-1">@foreach($errors->all() as $e)<li>• {{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Pertanyaan *</label>
                        <input type="text" name="pertanyaan" id="f-pertanyaan" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Jawaban *</label>
                        <textarea name="jawaban" id="f-jawaban" rows="5" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none resize-none"></textarea>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Kategori *</label>
                            <input type="text" name="kategori" id="f-kategori" required value="Umum" maxlength="50"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Urutan</label>
                            <input type="number" name="urutan" id="f-urutan" value="0" min="0"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                        </div>
                    </div>
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="is_active" id="f-active" value="1" checked class="w-4 h-4 text-primary rounded">
                        Tampilkan di halaman publik
                    </label>
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="closeModal()" class="flex-1 py-2.5 border border-gray-200 text-gray-600 font-bold rounded-lg text-sm hover:bg-gray-50">Batal</button>
                        <button type="submit" class="flex-1 py-2.5 bg-primary text-white font-bold rounded-lg text-sm hover:bg-primary-dark shadow-sm shadow-primary/20">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    const modal = document.getElementById('modal-faq');
    const form  = document.getElementById('form-faq');

    function openModal() {
        document.getElementById('modal-title').textContent = 'Tambah FAQ';
        form.action = "{{ route('admin.faq.store') }}";
        document.getElementById('form-method').value = 'POST';
        form.reset();
        document.getElementById('f-kategori').value = 'Umum';
        document.getElementById('f-urutan').value = '0';
        document.getElementById('f-active').checked = true;
        modal.classList.remove('hidden');
    }

    function openEditModal(f) {
        document.getElementById('modal-title').textContent = 'Edit FAQ';
        form.action = "{{ url('admin/faq') }}/" + f.id;
        document.getElementById('form-method').value = 'PATCH';
        document.getElementById('f-pertanyaan').value = f.pertanyaan;
        document.getElementById('f-jawaban').value    = f.jawaban;
        document.getElementById('f-kategori').value   = f.kategori;
        document.getElementById('f-urutan').value     = f.urutan;
        document.getElementById('f-active').checked   = !!f.is_active;
        modal.classList.remove('hidden');
    }

    function closeModal() { modal.classList.add('hidden'); }

    @if($errors->any())
        openModal();
    @endif
</script>
@endpush

@endsection
