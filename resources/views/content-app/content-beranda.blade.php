@extends('layout-app.main-app')

@section('title', 'Si-Padi — Sistem Pengaduan Warga')

@section('content')

{{-- ═══════════════════════════════════════════════
     SECTION 1 — HERO
═══════════════════════════════════════════════ --}}
<section id="beranda" class="relative noise hero-bg overflow-hidden pt-16">

    {{-- Decorative circles --}}
    <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-white/[.04] -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full bg-white/[.03] translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Left copy --}}
            <div>
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-1.5 text-xs text-white/80 mb-6 animate-fade-up">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>
                    Sistem aktif &amp; siap melayani 24/7
                </div>

                <h1 class="font-extrabold text-4xl sm:text-5xl lg:text-[56px] text-white leading-[1.1] tracking-tight mb-6 animate-fade-up-d1">
                    Suaramu penting.<br>
                    <span class="text-brand-200">Kami dengarkan.</span>
                </h1>

                <p class="text-white/70 text-lg leading-relaxed mb-8 max-w-lg animate-fade-up-d2">
                    Platform pengaduan warga yang transparan, terstruktur, dan dapat dilacak secara real-time. Laporkan masalah di lingkunganmu dalam hitungan menit.
                </p>

                <div class="flex flex-wrap gap-3 animate-fade-up-d3">
                    <a href="#pengaduan"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-white text-brand-700 font-bold rounded-xl hover:bg-brand-50 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Pengaduan
                    </a>
                    <a href="#lacak"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Lacak Tiket
                    </a>
                </div>
            </div>

            {{-- Right stats cards --}}
            <div class="grid grid-cols-2 gap-4 animate-fade-up-d2">
                @php
                    $stats = [
                        ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'num' => '1,248', 'label' => 'Total Pengaduan'],
                        ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0', 'num' => '98%', 'label' => 'Terselesaikan'],
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0', 'num' => '<24j', 'label' => 'Rata-rata Respons'],
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'num' => '6 RT', 'label' => 'Wilayah Terlayani'],
                    ];
                @endphp
                @foreach($stats as $i => $stat)
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 {{ $i === 0 ? 'col-span-2 sm:col-span-1' : '' }}">
                    <div class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="font-extrabold text-2xl text-white leading-none">{{ $stat['num'] }}</div>
                    <div class="text-white/60 text-xs mt-1">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Wave divider --}}
    <div class="relative z-10 -mb-1">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-12 sm:h-16">
            <path d="M0 60L60 50C120 40 240 20 360 16.7C480 13.3 600 26.7 720 30C840 33.3 960 26.7 1080 23.3C1200 20 1320 20 1380 20L1440 20V60H1380C1320 60 1200 60 1080 60C960 60 840 60 720 60C600 60 480 60 360 60C240 60 120 60 60 60H0Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>


{{-- ═══════════════════════════════════════════════
     SECTION 2 — FITUR SINGKAT
═══════════════════════════════════════════════ --}}
<section id="tentang" class="bg-slate-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="text-xs font-bold tracking-widest uppercase text-brand-600 mb-2 block">Kenapa SPW?</span>
            <h2 class="font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">Pengaduan yang benar-benar ditindak</h2>
            <p class="text-slate-500 mt-3 max-w-xl mx-auto text-sm leading-relaxed">Bukan sekadar laporan — setiap pengaduan diverifikasi, diproses, dan dikomunikasikan hasilnya kepada pelapor.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $features = [
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'blue',   'title' => 'Terverifikasi',    'desc' => 'Setiap laporan divalidasi petugas sebelum diproses lebih lanjut.'],
                    ['icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'color' => 'indigo', 'title' => 'Transparan',      'desc' => 'Lacak status pengaduan secara real-time dengan nomor tiket unik.'],
                    ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0',                        'color' => 'violet', 'title' => 'Cepat Respons',   'desc' => 'Target respons kurang dari 24 jam untuk pengaduan prioritas tinggi.'],
                    ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'color' => 'sky',    'title' => 'Balasan Resmi',   'desc' => 'Petugas memberikan tanggapan resmi langsung di halaman tiket.'],
                    ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01', 'color' => 'teal',   'title' => 'Riwayat Lengkap', 'desc' => 'Semua laporan Anda tersimpan dan dapat diakses kapan saja.'],
                    ['icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z',                                                       'color' => 'emerald', 'title' => 'Aman & Privat',  'desc' => 'Data identitas pelapor dijaga kerahasiaannya sesuai regulasi.'],
                ];
                $colorMap = [
                    'blue'   => ['bg' => 'bg-blue-50',   'icon' => 'text-blue-600'],
                    'indigo' => ['bg' => 'bg-indigo-50', 'icon' => 'text-indigo-600'],
                    'violet' => ['bg' => 'bg-violet-50', 'icon' => 'text-violet-600'],
                    'sky'    => ['bg' => 'bg-sky-50',    'icon' => 'text-sky-600'],
                    'teal'   => ['bg' => 'bg-teal-50',   'icon' => 'text-teal-600'],
                    'emerald'=> ['bg' => 'bg-emerald-50','icon' => 'text-emerald-600'],
                ];
            @endphp
            @foreach($features as $f)
            @php $c = $colorMap[$f['color']]; @endphp
            <div class="feature-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-11 h-11 rounded-xl {{ $c['bg'] }} flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 {{ $c['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-bold text-slate-900 mb-1.5">{{ $f['title'] }}</h3>
                <p class="text-slate-500 text-sm leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════
     SECTION 3 — TABS: PENGADUAN + LACAK
═══════════════════════════════════════════════ --}}
<section id="pengaduan" class="py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Tab switcher --}}
        <div class="flex gap-2 bg-slate-100 rounded-2xl p-1.5 mb-10">
            <button onclick="switchTab('form')"  id="tab-form"  class="tab-btn active flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Buat Pengaduan
            </button>
            <button onclick="switchTab('lacak')" id="tab-lacak" id="lacak" class="tab-btn flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold text-slate-500 transition-all duration-200 hover:text-slate-700">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Lacak Pengaduan
            </button>
        </div>

        {{-- ─── TAB FORM PENGADUAN ─── --}}
        <div id="panel-form">
            <div class="mb-8">
                <h2 class="font-extrabold text-2xl text-slate-900 mb-1">Formulir Pengaduan</h2>
                <p class="text-slate-500 text-sm">Isi data dengan lengkap dan benar. Nomor tiket akan dikirim otomatis setelah formulir dikirim.</p>
            </div>

            @if(session('tiket_baru'))
            <div class="bg-brand-50 border border-brand-200 rounded-2xl p-5 mb-6 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <p class="font-bold text-brand-800 text-sm">Pengaduan berhasil dikirim!</p>
                    <p class="text-brand-600 text-sm mt-0.5">Nomor tiket Anda: <strong class="font-extrabold text-brand-700">{{ session('tiket_baru') }}</strong></p>
                    <p class="text-brand-500 text-xs mt-1">Simpan nomor tiket ini untuk melacak status pengaduan Anda.</p>
                </div>
            </div>
            @endif

            <form method="POST" action="" class="space-y-5">
                @csrf

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Kategori Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach(['Infrastruktur','Kebersihan','Keamanan','Administrasi','Sosial','Lainnya'] as $kat)
                        <label class="kategori-option cursor-pointer">
                            <input type="radio" name="kategori" value="{{ $kat }}" class="sr-only peer"
                                {{ old('kategori') === $kat ? 'checked' : '' }}>
                            <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl border-[1.5px] border-slate-200 bg-slate-50
                                        peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-700
                                        hover:border-brand-300 transition-all text-sm font-medium text-slate-600">
                                @php
                                    $icons = ['Infrastruktur'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4','Kebersihan'=>'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16','Keamanan'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','Administrasi'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2','Sosial'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','Lainnya'=>'M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0'];
                                @endphp
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons[$kat] }}"/>
                                </svg>
                                {{ $kat }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('kategori') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Identitas --}}
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_pelapor" class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_pelapor" name="nama_pelapor"
                            placeholder="Nama lengkap Anda"
                            value="{{ old('nama_pelapor') }}"
                            class="form-input w-full h-11 px-4 border-[1.5px] border-slate-200 rounded-xl text-sm bg-slate-50 transition-all
                                {{ $errors->has('nama_pelapor') ? 'border-red-400 bg-red-50' : '' }}">
                        @error('nama_pelapor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="nomor_hp" class="block text-sm font-semibold text-slate-700 mb-2">
                            Nomor HP Aktif <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="nomor_hp" name="nomor_hp"
                            placeholder="08xx-xxxx-xxxx"
                            value="{{ old('nomor_hp') }}"
                            class="form-input w-full h-11 px-4 border-[1.5px] border-slate-200 rounded-xl text-sm bg-slate-50 transition-all
                                {{ $errors->has('nomor_hp') ? 'border-red-400 bg-red-50' : '' }}">
                        @error('nomor_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="rt_rw" class="block text-sm font-semibold text-slate-700 mb-2">
                        RT/RW <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="rt_rw" name="rt_rw"
                        placeholder="Contoh: 001/002"
                        value="{{ old('rt_rw') }}"
                        class="form-input w-full h-11 px-4 border-[1.5px] border-slate-200 rounded-xl text-sm bg-slate-50 transition-all max-w-[200px]
                            {{ $errors->has('rt_rw') ? 'border-red-400 bg-red-50' : '' }}">
                    @error('rt_rw') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Urgensi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Tingkat Urgensi <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-3 flex-wrap">
                        @foreach([
                            ['val'=>'Rendah',  'color'=>'text-green-700 border-green-200 bg-green-50 peer-checked:border-green-500 peer-checked:bg-green-100'],
                            ['val'=>'Sedang',  'color'=>'text-amber-700 border-amber-200 bg-amber-50 peer-checked:border-amber-500 peer-checked:bg-amber-100'],
                            ['val'=>'Tinggi',  'color'=>'text-red-700 border-red-200 bg-red-50 peer-checked:border-red-500 peer-checked:bg-red-100'],
                        ] as $u)
                        <label class="cursor-pointer">
                            <input type="radio" name="urgensi" value="{{ $u['val'] }}" class="sr-only peer"
                                {{ old('urgensi') === $u['val'] ? 'checked' : '' }}>
                            <div class="px-4 py-2 rounded-xl border-[1.5px] font-semibold text-sm transition-all {{ $u['color'] }}">
                                {{ $u['val'] }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('urgensi') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Judul --}}
                <div>
                    <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">
                        Judul Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul" name="judul"
                        placeholder="Ringkasan singkat permasalahan"
                        value="{{ old('judul') }}"
                        class="form-input w-full h-11 px-4 border-[1.5px] border-slate-200 rounded-xl text-sm bg-slate-50 transition-all
                            {{ $errors->has('judul') ? 'border-red-400 bg-red-50' : '' }}">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-2">
                        Deskripsi Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="5"
                        placeholder="Jelaskan secara detail: lokasi kejadian, waktu, dan dampak yang dirasakan..."
                        class="form-input w-full px-4 py-3 border-[1.5px] border-slate-200 rounded-xl text-sm bg-slate-50 transition-all resize-none
                            {{ $errors->has('deskripsi') ? 'border-red-400 bg-red-50' : '' }}">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full h-12 flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl
                        shadow-[0_4px_16px_rgba(26,86,219,.3)] hover:shadow-[0_6px_24px_rgba(26,86,219,.35)]
                        transition-all hover:-translate-y-0.5 active:translate-y-0 text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Kirim Pengaduan
                </button>
            </form>
        </div>


        {{-- ─── TAB LACAK PENGADUAN ─── --}}
        <div id="panel-lacak" class="hidden" id="lacak">
            <div class="mb-8">
                <h2 class="font-extrabold text-2xl text-slate-900 mb-1">Lacak Pengaduan</h2>
                <p class="text-slate-500 text-sm">Masukkan nomor tiket untuk melihat status dan riwayat pengaduan Anda.</p>
            </div>

            {{-- Search tiket --}}
            <form method="GET" action="" class="flex gap-2 mb-8">
                <div class="relative flex-1">
                    <input type="text" name="tiket"
                        placeholder="PDU-2025-001"
                        value="{{ request('tiket') }}"
                        class="form-input w-full h-12 pl-11 pr-4 border-[1.5px] border-slate-200 rounded-xl text-sm bg-slate-50 font-mono transition-all">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <button type="submit"
                    class="px-5 h-12 bg-brand-600 text-white font-semibold rounded-xl text-sm hover:bg-brand-700 transition-all shadow-sm">
                    Cari
                </button>
            </form>

            {{-- Hasil pencarian --}}
            @if(isset($pengaduan))
            <div class="space-y-5">
                {{-- Header tiket --}}
                <div class="bg-brand-50 border border-brand-100 rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-4 flex-wrap">
                        <div>
                            <p class="text-xs text-brand-500 font-semibold mb-1">Nomor Tiket</p>
                            <p class="font-extrabold text-brand-800 text-xl font-mono">{{ $pengaduan->nomor_tiket }}</p>
                        </div>
                        @php
                            $urgensiColor = match($pengaduan->urgensi) {
                                'Tinggi' => 'bg-red-100 text-red-700 border-red-200',
                                'Sedang' => 'bg-amber-100 text-amber-700 border-amber-200',
                                default  => 'bg-green-100 text-green-700 border-green-200',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $urgensiColor }}">
                            {{ $pengaduan->urgensi }}
                        </span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-brand-200 grid sm:grid-cols-2 gap-2 text-sm">
                        <div><span class="text-slate-500 text-xs">Kategori</span><p class="font-semibold text-slate-800">{{ $pengaduan->kategori }}</p></div>
                        <div><span class="text-slate-500 text-xs">Dilaporkan</span><p class="font-semibold text-slate-800">{{ $pengaduan->created_at->format('d M Y, H:i') }}</p></div>
                        <div class="sm:col-span-2"><span class="text-slate-500 text-xs">Judul</span><p class="font-semibold text-slate-800">{{ $pengaduan->judul }}</p></div>
                    </div>
                </div>

                {{-- Timeline 4 tahap --}}
                <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-5 text-sm">Progress Penanganan</h3>
                    @php
                        $steps = [
                            ['key'=>'diterima',    'label'=>'Diterima',    'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                            ['key'=>'diverifikasi','label'=>'Diverifikasi','icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                            ['key'=>'diproses',    'label'=>'Diproses',    'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                            ['key'=>'selesai',     'label'=>'Selesai',     'icon'=>'M5 13l4 4L19 7'],
                        ];
                        $currentStep = $pengaduan->status ?? 'diterima';
                        $stepOrder = ['diterima'=>0,'diverifikasi'=>1,'diproses'=>2,'selesai'=>3];
                        $currentIdx = $stepOrder[$currentStep] ?? 0;
                    @endphp
                    <div class="tl-track space-y-4">
                        @foreach($steps as $i => $step)
                        @php
                            $done    = $i < $currentIdx;
                            $active  = $i === $currentIdx;
                            $pending = $i > $currentIdx;
                        @endphp
                        <div class="flex items-start gap-4 pl-2">
                            <div class="relative z-10 w-10 h-10 rounded-full flex items-center justify-center shrink-0
                                {{ $done   ? 'bg-brand-600 text-white' : '' }}
                                {{ $active ? 'bg-brand-100 text-brand-600 ring-2 ring-brand-400 ring-offset-2' : '' }}
                                {{ $pending? 'bg-slate-100 text-slate-400' : '' }}">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/>
                                </svg>
                            </div>
                            <div class="pt-2 pb-4 flex-1 border-b border-slate-100 last:border-0">
                                <p class="font-semibold text-sm {{ $pending ? 'text-slate-400' : 'text-slate-800' }}">
                                    {{ $step['label'] }}
                                    @if($active)
                                    <span class="ml-2 text-[10px] font-bold bg-brand-100 text-brand-700 px-2 py-0.5 rounded-full">Saat ini</span>
                                    @endif
                                </p>
                                @if($done || $active)
                                <p class="text-xs text-slate-500 mt-0.5">{{ now()->subDays($currentIdx - $i)->format('d M Y') }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Balasan petugas --}}
                @if($pengaduan->balasan)
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 rounded-full bg-brand-600 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-700">Balasan Resmi Petugas</p>
                            <p class="text-[10px] text-slate-400">{{ $pengaduan->balasan_at?->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $pengaduan->balasan }}</p>
                </div>
                @endif

                {{-- Deskripsi pengaduan --}}
                <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-3 text-sm">Detail Pengaduan</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $pengaduan->deskripsi }}</p>
                </div>
            </div>

            @elseif(request('tiket') && !isset($pengaduan))
            <div class="text-center py-14">
                <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="font-semibold text-slate-700">Tiket tidak ditemukan</p>
                <p class="text-slate-400 text-sm mt-1">Pastikan nomor tiket yang Anda masukkan sudah benar.</p>
            </div>

            @else
            {{-- Riwayat pengaduan (jika ada session atau login) --}}
            <div class="text-center py-14">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center mx-auto mb-4 animate-float">
                    <svg class="w-7 h-7 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <p class="font-semibold text-slate-700">Masukkan nomor tiket</p>
                <p class="text-slate-400 text-sm mt-1">Format: <span class="font-mono font-semibold text-brand-600">PDU-YYYY-XXX</span></p>
            </div>
            @endif
        </div>

    </div>
</section>


{{-- ═══════════════════════════════════════════════
     SECTION 4 — CTA BANNER
═══════════════════════════════════════════════ --}}
<section class="bg-brand-600 py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="font-extrabold text-3xl text-white mb-3 tracking-tight">Ada masalah di lingkunganmu?</h2>
        <p class="text-brand-200 text-sm mb-7 leading-relaxed">Jangan biarkan masalah berlarut. Laporkan sekarang dan kami pastikan ditindak serius.</p>
        <a href="#pengaduan"
           class="inline-flex items-center gap-2 px-6 py-3 bg-white text-brand-700 font-bold rounded-xl hover:bg-brand-50 transition-all shadow-lg hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Buat Laporan Sekarang
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function switchTab(tab) {
        const btnForm  = document.getElementById('tab-form');
        const btnLacak = document.getElementById('tab-lacak');
        const panelForm  = document.getElementById('panel-form');
        const panelLacak = document.getElementById('panel-lacak');

        if (tab === 'form') {
            btnForm.classList.add('active');
            btnLacak.classList.remove('active');
            btnLacak.classList.add('text-slate-500');
            panelForm.classList.remove('hidden');
            panelLacak.classList.add('hidden');
        } else {
            btnLacak.classList.add('active');
            btnForm.classList.remove('active');
            btnForm.classList.add('text-slate-500');
            panelLacak.classList.remove('hidden');
            panelForm.classList.add('hidden');
        }
    }

    // Buka tab lacak jika URL mengandung #lacak
    if (window.location.hash === '#lacak' || new URLSearchParams(window.location.search).has('tiket')) {
        switchTab('lacak');
    }
</script>
@endpush