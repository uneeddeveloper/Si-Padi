@extends('layout-admin.main-layout-admin')

@section('title', 'Manajemen Instansi')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">Dashboard</a>
                <i class="bi bi-chevron-right text-[10px]"></i>
                <span class="text-gray-400">Instansi</span>
            </div>
            <h1 class="font-grotesk text-2xl font-bold text-gray-800 tracking-tight">Manajemen Instansi</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data Dinas/OPD yang menangani pengaduan masyarakat.</p>
        </div>
        <button onclick="openModal()"
            class="px-4 py-2 bg-primary text-white rounded-lg text-xs font-bold hover:bg-primary-dark transition-all flex items-center gap-2 shadow-sm shadow-primary/20">
            <i class="bi bi-plus-lg"></i> Tambah Instansi
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm flex items-center gap-2">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Search --}}
    <form method="GET" class="mb-4 flex gap-2">
        <div class="relative flex-1 max-w-md">
            <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, kode, atau penanggung jawab..."
                class="w-full pl-9 pr-4 py-2 bg-white border border-[#e2e8f0] rounded-lg text-sm focus:border-primary outline-none transition-all">
        </div>
        <button type="submit" class="px-4 py-2 bg-white border border-[#e2e8f0] rounded-lg text-xs font-bold hover:bg-bg-base">
            Cari
        </button>
    </form>

    {{-- Tabel --}}
    <div class="bg-white rounded-radius border border-[#e2e8f0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50/50 border-b border-[#e2e8f0]">
            <h3 class="font-bold text-sm text-gray-700 flex items-center gap-2">
                <i class="bi bi-building text-primary"></i> Daftar Instansi ({{ $instansis->total() }})
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead class="bg-gray-50 text-gray-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="px-6 py-4 border-b">Kode</th>
                        <th class="px-6 py-4 border-b">Nama Instansi</th>
                        <th class="px-6 py-4 border-b">Penanggung Jawab</th>
                        <th class="px-6 py-4 border-b">Kontak</th>
                        <th class="px-6 py-4 border-b text-center">Status</th>
                        <th class="px-6 py-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($instansis as $i)
                        <tr class="hover:bg-bg-base/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-primary-light text-primary font-mono font-bold text-[10px] rounded">
                                    {{ $i->kode }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $i->nama }}</div>
                                @if($i->alamat)
                                    <div class="text-[11px] text-gray-400 mt-0.5"><i class="bi bi-geo-alt"></i> {{ $i->alamat }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $i->penanggung_jawab ?: '—' }}</td>
                            <td class="px-6 py-4 text-xs">
                                @if($i->email)<div class="text-gray-600"><i class="bi bi-envelope"></i> {{ $i->email }}</div>@endif
                                @if($i->nomor_telepon)<div class="text-gray-500"><i class="bi bi-telephone"></i> {{ $i->nomor_telepon }}</div>@endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($i->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full bg-green-50 text-green-600 text-[10px] font-bold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full bg-gray-100 text-gray-500 text-[10px] font-bold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                        onclick='openEditModal(@json($i))'
                                        class="w-8 h-8 flex items-center justify-center border border-gray-200 rounded-lg text-gray-400 hover:text-primary hover:border-primary-light hover:bg-primary-light transition-all">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    @if(Auth::user()->role === 'superadmin')
                                        <form action="{{ route('admin.instansi.destroy', $i) }}" method="POST"
                                              onsubmit="return confirm('Hapus instansi {{ $i->nama }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center border border-gray-200 rounded-lg text-gray-400 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-all">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-gray-400 text-sm">Belum ada data instansi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($instansis->hasPages())
            <div class="px-6 py-3 border-t border-gray-100">{{ $instansis->links() }}</div>
        @endif
    </div>

    {{-- Modal Form --}}
    <div id="modal-instansi" class="hidden fixed inset-0 bg-black/50 z-[1100] overflow-y-auto">
        <div class="flex items-start justify-center min-h-full p-4 py-10">
            <div class="bg-white rounded-radius shadow-2xl w-full max-w-xl">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="bi bi-building text-primary"></i> <span id="modal-title">Tambah Instansi</span>
                    </h3>
                    <button onclick="closeModal()"
                        class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 transition-all">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <form id="form-instansi" action="{{ route('admin.instansi.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <input type="hidden" name="_method" id="form-method" value="POST">

                    @if($errors->any())
                        <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-xs text-red-600">
                            <ul class="space-y-1">
                                @foreach($errors->all() as $e) <li>• {{ $e }}</li> @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Nama Instansi *</label>
                            <input type="text" name="nama" id="f-nama" required
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Kode *</label>
                            <input type="text" name="kode" id="f-kode" required maxlength="20"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none uppercase">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" id="f-pj"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Email</label>
                            <input type="email" name="email" id="f-email"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" id="f-telp"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Alamat</label>
                        <input type="text" name="alamat" id="f-alamat"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="f-desk" rows="3"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none resize-none"></textarea>
                    </div>

                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="is_active" id="f-active" value="1" checked
                            class="w-4 h-4 text-primary rounded">
                        Instansi aktif
                    </label>

                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="closeModal()"
                            class="flex-1 py-2.5 border border-gray-200 text-gray-600 font-bold rounded-lg text-sm hover:bg-gray-50">Batal</button>
                        <button type="submit"
                            class="flex-1 py-2.5 bg-primary text-white font-bold rounded-lg text-sm hover:bg-primary-dark shadow-sm shadow-primary/20">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    const modal = document.getElementById('modal-instansi');
    const form  = document.getElementById('form-instansi');

    function openModal() {
        document.getElementById('modal-title').textContent = 'Tambah Instansi';
        form.action = "{{ route('admin.instansi.store') }}";
        document.getElementById('form-method').value = 'POST';
        form.reset();
        document.getElementById('f-active').checked = true;
        modal.classList.remove('hidden');
    }

    function openEditModal(item) {
        document.getElementById('modal-title').textContent = 'Edit Instansi';
        form.action = "{{ url('admin/instansi') }}/" + item.id;
        document.getElementById('form-method').value = 'PATCH';
        document.getElementById('f-nama').value   = item.nama;
        document.getElementById('f-kode').value   = item.kode;
        document.getElementById('f-pj').value     = item.penanggung_jawab ?? '';
        document.getElementById('f-email').value  = item.email ?? '';
        document.getElementById('f-telp').value   = item.nomor_telepon ?? '';
        document.getElementById('f-alamat').value = item.alamat ?? '';
        document.getElementById('f-desk').value   = item.deskripsi ?? '';
        document.getElementById('f-active').checked = !!item.is_active;
        modal.classList.remove('hidden');
    }

    function closeModal() { modal.classList.add('hidden'); }

    @if($errors->any())
        openModal();
    @endif
</script>
@endpush

@endsection
