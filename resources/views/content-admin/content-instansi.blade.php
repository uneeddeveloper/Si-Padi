@extends('layout-admin.main-layout-admin')

@section('title', 'Data Instansi')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">Dashboard</a>
                <i class="bi bi-chevron-right text-[10px]"></i>
                <span class="text-gray-400">Data Instansi</span>
            </div>
            <h1 class="font-grotesk text-2xl font-bold text-gray-800 tracking-tight">Data Instansi</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola daftar instansi/dinas yang menangani pengaduan masyarakat.</p>
        </div>
        <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
            class="px-4 py-2 bg-primary text-white rounded-lg text-xs font-bold hover:bg-primary-dark transition-all flex items-center gap-2 shadow-sm shadow-primary/20">
            <i class="bi bi-plus-lg"></i> Tambah Instansi
        </button>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm flex items-center gap-2">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm flex items-center gap-2">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-radius border border-[#e2e8f0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50/50 border-b border-[#e2e8f0]">
            <h3 class="font-bold text-sm text-gray-700 flex items-center gap-2">
                <i class="bi bi-building text-primary"></i> Daftar Instansi ({{ $instansis->count() }})
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead class="bg-gray-50 text-gray-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="px-6 py-4 border-b">Instansi</th>
                        <th class="px-6 py-4 border-b">Bidang</th>
                        <th class="px-6 py-4 border-b">Kontak</th>
                        <th class="px-6 py-4 border-b">Alamat</th>
                        <th class="px-6 py-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($instansis as $inst)
                        <tr class="hover:bg-bg-base/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-primary-light flex items-center justify-center text-primary text-base">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $inst->nama }}</div>
                                        @if($inst->email)
                                            <div class="text-[11px] text-gray-400">{{ $inst->email }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-xs">{{ $inst->bidang }}</td>
                            <td class="px-6 py-4 text-gray-600 text-xs">{{ $inst->kontak ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ Str::limit($inst->alamat ?? '—', 50) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal({{ $inst->id }}, '{{ addslashes($inst->nama) }}', '{{ addslashes($inst->bidang) }}', '{{ addslashes($inst->kontak ?? '') }}', '{{ addslashes($inst->email ?? '') }}', '{{ addslashes($inst->alamat ?? '') }}')"
                                        class="w-8 h-8 flex items-center justify-center border border-gray-200 rounded-lg text-gray-400 hover:text-amber-600 hover:border-amber-200 hover:bg-amber-50 transition-all">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    @if(Auth::user()->role === 'superadmin')
                                        <form action="{{ route('admin.instansi.destroy', $inst) }}" method="POST"
                                            onsubmit="return confirm('Hapus instansi {{ $inst->nama }}?')">
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
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <i class="bi bi-building text-4xl block mb-2 opacity-20"></i>
                                <p class="text-sm italic">Belum ada instansi. Klik "Tambah Instansi" untuk menambahkan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div id="modal-tambah" class="hidden fixed inset-0 bg-black/50 z-[1100]">
        <div class="flex items-center justify-center min-h-full p-4">
        <div class="bg-white rounded-radius shadow-2xl w-full max-w-md max-h-screen overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="bi bi-building-add text-primary"></i> Tambah Instansi
                </h3>
                <button onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 transition-all">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form action="{{ route('admin.instansi.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                @if($errors->any())
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-xs text-red-600">
                        <ul class="space-y-1">
                            @foreach($errors->all() as $e) <li>• {{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Nama Instansi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none"
                        placeholder="Contoh: Dinas Pekerjaan Umum">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Bidang <span class="text-red-500">*</span></label>
                    <input type="text" name="bidang" value="{{ old('bidang') }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none"
                        placeholder="Contoh: Infrastruktur dan Jalan">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Nomor Kontak</label>
                    <input type="text" name="kontak" value="{{ old('kontak') }}"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none"
                        placeholder="08xx-xxxx-xxxx">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none"
                        placeholder="instansi@example.com">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Alamat</label>
                    <textarea name="alamat" rows="2"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none resize-none"
                        placeholder="Alamat kantor...">{{ old('alamat') }}</textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                        class="flex-1 py-2.5 border border-gray-200 text-gray-600 font-bold rounded-lg text-sm hover:bg-gray-50 transition-all">Batal</button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-primary text-white font-bold rounded-lg text-sm hover:bg-primary-dark transition-all">Simpan</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="modal-edit" class="hidden fixed inset-0 bg-black/50 z-[1100]">
        <div class="flex items-center justify-center min-h-full p-4">
        <div class="bg-white rounded-radius shadow-2xl w-full max-w-md max-h-screen overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="bi bi-pencil-square text-amber-600"></i> Edit Instansi
                </h3>
                <button onclick="document.getElementById('modal-edit').classList.add('hidden')"
                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 transition-all">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form id="form-edit" method="POST" class="p-6 space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Nama Instansi <span class="text-red-500">*</span></label>
                    <input type="text" id="edit-nama" name="nama" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Bidang <span class="text-red-500">*</span></label>
                    <input type="text" id="edit-bidang" name="bidang" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Nomor Kontak</label>
                    <input type="text" id="edit-kontak" name="kontak"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Email</label>
                    <input type="email" id="edit-email" name="email"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Alamat</label>
                    <textarea id="edit-alamat" name="alamat" rows="2"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:border-primary outline-none resize-none"></textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="flex-1 py-2.5 border border-gray-200 text-gray-600 font-bold rounded-lg text-sm hover:bg-gray-50 transition-all">Batal</button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-amber-500 text-white font-bold rounded-lg text-sm hover:bg-amber-600 transition-all">Perbarui</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openEditModal(id, nama, bidang, kontak, email, alamat) {
            const base = '{{ url("admin/instansi") }}';
            document.getElementById('form-edit').action = base + '/' + id;
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-bidang').value = bidang;
            document.getElementById('edit-kontak').value = kontak;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-alamat').value = alamat;
            document.getElementById('modal-edit').classList.remove('hidden');
        }
        @if($errors->any())
            document.getElementById('modal-tambah').classList.remove('hidden');
        @endif
    </script>
    @endpush

@endsection
