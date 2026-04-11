@extends('layout-admin.main-layout-admin')

@section('title', 'Dashboard')

@section('content')

                    @php
    $user = Auth::user();
    $authRole = $user->role;
    $isSuperAdmin = $authRole === 'superadmin';

    $totalPengaduan = \App\Models\Pengaduan::count();
    $pengaduanMasuk = \App\Models\Pengaduan::where('status', 'masuk')->count();
    $pengaduanProses = \App\Models\Pengaduan::where('status', 'proses')->count();
    $pengaduanSelesai = \App\Models\Pengaduan::where('status', 'selesai')->count();
    $totalUser = \App\Models\User::where('role', 'user')->count();

    $recentPengaduan = \App\Models\Pengaduan::with('user')->latest()->take(6)->get();
                    @endphp

                    {{-- Welcome Banner --}}
                    <div class="relative overflow-hidden rounded-radius p-8 mb-6 text-white bg-gradient-to-br {{ $isSuperAdmin ? 'from-[#4c1d95] via-[#6d28d9] to-[#7c3aed]' : 'from-[#134f2d] via-[#1a6b3c] to-[#2d9b5a]' }}">
                        <div class="relative z-10">
                            <div class="text-xs text-white/60 mb-1">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</div>
                            <h2 class="font-grotesk text-2xl font-bold mb-1">
                                {{ $isSuperAdmin ? '👑' : '🛡️' }} Selamat datang, {{ $user->name }}!
                            </h2>
                            <p class="text-sm text-white/70 max-w-lg mb-5">
                                {{ $isSuperAdmin ? 'Anda memiliki kendali penuh atas sistem informasi pengaduan masyarakat SI PADI.' : 'Pantau dan kelola pengaduan masyarakat dari dashboard administrator.' }}
                            </p>
                            <div class="flex gap-3">
                                <a href="" class="px-4 py-2 bg-white/20 hover:bg-white/30 border border-white/20 rounded-lg text-xs font-bold transition-all flex items-center gap-2">
                                    {{-- {{ route('admin.pengaduan.index') }} --}}
                                    <i class="bi bi-megaphone"></i> Lihat Pengaduan
                                </a>
                            </div>
                        </div>
                        <i class="bi {{ $isSuperAdmin ? 'bi-shield-fill-check' : 'bi-shield-check' }} absolute -right-4 -bottom-4 text-9xl opacity-10"></i>
                    </div>

                    {{-- Stat Cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        {{-- Card 1 --}}
                        <div class="bg-white p-5 rounded-radius border border-[#e2e8f0] shadow-sm relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-primary"></div>
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Laporan</div>
                                    <div class="font-grotesk text-3xl font-bold text-gray-800">{{ number_format($totalPengaduan) }}</div>
                                </div>
                                <div class="w-10 h-10 bg-primary-light text-primary rounded-xl flex items-center justify-center text-lg"><i class="bi bi-megaphone"></i></div>
                            </div>
                        </div>
                        {{-- Card 2 --}}
                        <div class="bg-white p-5 rounded-radius border border-[#e2e8f0] shadow-sm relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-red-500"></div>
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Belum Diproses</div>
                                    <div class="font-grotesk text-3xl font-bold text-gray-800">{{ number_format($pengaduanMasuk) }}</div>
                                </div>
                                <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center text-lg"><i class="bi bi-inbox"></i></div>
                            </div>
                        </div>
                        {{-- Card 3 --}}
                        <div class="bg-white p-5 rounded-radius border border-[#e2e8f0] shadow-sm relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-amber-500"></div>
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Sedang Proses</div>
                                    <div class="font-grotesk text-3xl font-bold text-gray-800">{{ number_format($pengaduanProses) }}</div>
                                </div>
                                <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center text-lg"><i class="bi bi-arrow-repeat"></i></div>
                            </div>
                        </div>
                        {{-- Card 4 --}}
                        <div class="bg-white p-5 rounded-radius border border-[#e2e8f0] shadow-sm relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-blue-500"></div>
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Selesai</div>
                                    <div class="font-grotesk text-3xl font-bold text-gray-800">{{ number_format($pengaduanSelesai) }}</div>
                                </div>
                                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-lg"><i class="bi bi-patch-check"></i></div>
                            </div>
                        </div>
                    </div>

                    {{-- Main Content Grid --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        {{-- Table --}}
                        <div class="lg:col-span-2 bg-white rounded-radius border border-[#e2e8f0] shadow-sm overflow-hidden flex flex-col">
                            <div class="px-6 py-4 border-b border-[#e2e8f0] flex justify-between items-center">
                                <h3 class="font-bold text-sm text-gray-700 flex items-center gap-2">
                                    <i class="bi bi-list-ul text-primary"></i> Pengaduan Terbaru
                                </h3>
                                <a href="" class="text-[11px] font-bold text-primary hover:underline">Lihat Semua</a>
                                {{-- {{ route('admin.pengaduan.index') }} --}}
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse text-xs">
                                    <thead class="bg-bg-base text-gray-500 font-bold uppercase tracking-wider text-[10px]">
                                        <tr>
                                            <th class="px-6 py-3 border-b">Pelapor</th>
                                            <th class="px-6 py-3 border-b">Judul</th>
                                            <th class="px-6 py-3 border-b">Status</th>
                                            <th class="px-6 py-3 border-b text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($recentPengaduan as $item)
                                            <tr class="hover:bg-bg-base transition-colors">
                                                <td class="px-6 py-4 font-bold text-gray-700">{{ Str::limit($item->user->name ?? '-', 20) }}</td>
                                                <td class="px-6 py-4 text-gray-500">{{ Str::limit($item->judul, 40) }}</td>
                                                <td class="px-6 py-4">
                                                    @if($item->status == 'masuk')
                                                        <span class="px-2 py-0.5 rounded-full bg-red-100 text-red-600 text-[10px] font-bold uppercase">Masuk</span>
                                                    @elseif($item->status == 'proses')
                                                        <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-600 text-[10px] font-bold uppercase">Proses</span>
                                                    @else
                                                        <span class="px-2 py-0.5 rounded-full bg-green-100 text-green-600 text-[10px] font-bold uppercase">Selesai</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <a href="" class="w-7 h-7 inline-flex items-center justify-center border border-gray-200 rounded-md hover:bg-white transition-all text-gray-400 hover:text-primary">
                                                        {{-- {{ route('admin.pengaduan.show', $item->id) }} --}}
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Side Column --}}
                        <div class="space-y-6">
                            {{-- Statistik --}}
                            <div class="bg-white rounded-radius border border-[#e2e8f0] shadow-sm p-6">
                                <h3 class="text-sm font-bold text-gray-700 mb-5 flex items-center gap-2">
                                    <i class="bi bi-pie-chart text-primary"></i> Persentase Status
                                </h3>
                                <div class="space-y-4">
                                    @php 
                                                                $divider = $totalPengaduan > 0 ? $totalPengaduan : 1;
    $stats = [
        ['label' => 'Selesai', 'val' => $pengaduanSelesai, 'color' => 'bg-green-500'],
        ['label' => 'Proses', 'val' => $pengaduanProses, 'color' => 'bg-amber-500'],
        ['label' => 'Masuk', 'val' => $pengaduanMasuk, 'color' => 'bg-red-500'],
    ];
                                    @endphp
                                    @foreach($stats as $s)
                                        <div>
                                            <div class="flex justify-between text-[11px] font-bold mb-1.5 uppercase tracking-wide">
                                                <span class="text-gray-500">{{ $s['label'] }}</span>
                                                <span class="text-gray-800">{{ round(($s['val'] / $divider) * 100) }}%</span>
                                            </div>
                                            <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full {{ $s['color'] }}" style="width: {{ ($s['val'] / $divider) * 100 }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Info Masyarakat --}}
                            <div class="bg-white rounded-radius border border-[#e2e8f0] shadow-sm p-6">
                                 <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-sm font-bold text-gray-700 flex items-center gap-2">
                                        <i class="bi bi-people text-primary"></i> Masyarakat
                                    </h3>
                                    <span class="text-xs font-grotesk font-bold text-primary">{{ number_format($totalUser) }} Akun</span>
                                 </div>
                                 <p class="text-[11px] text-gray-500 leading-relaxed mb-4">Total masyarakat yang telah terdaftar di sistem SI PADI untuk menyampaikan aspirasi.</p>
                                 <a href="" class="block text-center py-2 bg-bg-base text-primary text-[11px] font-bold rounded-lg hover:bg-primary-light transition-all">Kelola Pengguna</a>
                                 {{-- {{ route('admin.users.index') }} --}}
                            </div>
                        </div>

                    </div>

@endsection