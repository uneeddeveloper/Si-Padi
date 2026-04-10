<header id="navbar" class="fixed top-0 inset-x-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('beranda') }}" class="flex items-center gap-2.5 group">
                <div
                    class="w-9 h-9 rounded-xl bg-brand-600 flex items-center justify-center shadow-md group-hover:bg-brand-700 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                </div>
                <div class="leading-tight">
                    <span class="font-extrabold text-lg text-white tracking-tight leading-none block"
                        id="nav-brand">si-padi</span>
                    <span class="text-[10px] text-white/60 leading-none" id="nav-sub">Sistem Informasi Pengaduan
                        Masyarakat Desa</span>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-1">
                <a href="{{ route('beranda') }}"
                    class="nav-link px-4 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">Beranda</a>
                <a href="{{ route('pengaduan') }}"
                    class="nav-link px-4 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">Buat
                    Pengaduan </a>

                <a href="{{ route('tentang') }}"
                    class="nav-link px-4 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">Tentang</a>
                <a href="{{ route('riwayat') }}"
                    class="nav-link px-4 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">Riwayat
                    Pengaduan </a>
            </nav>
            {{-- CTA --}}
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-sm font-semibold text-white/90 hover:text-white transition-colors">
                    Masuk
                </a>
                <a href="#pengaduan"
                    class="px-4 py-2 bg-white text-brand-700 text-sm font-bold rounded-xl hover:bg-brand-50 transition-all shadow-sm">
                    Laporkan Sekarang
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button id="menuBtn"
                class="md:hidden p-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="hidden md:hidden border-t border-white/10 bg-brand-800/95 backdrop-blur-md">
        <div class="px-4 py-3 space-y-1">
            <a href="#beranda"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition">Beranda</a>
            <a href="#pengaduan"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition">Buat
                Pengaduan</a>
            <a href="#lacak"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition">Lacak
                Pengaduan</a>
            <a href="{{ route('tentang') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition">Tentang</a>
            <div class="pt-2 border-t border-white/10 flex gap-2">
                <a href="{{ route('login') }}"
                    class="flex-1 text-center px-3 py-2 rounded-lg text-sm font-semibold text-white/80 hover:bg-white/10 transition">Masuk</a>
                <a href="#pengaduan"
                    class="flex-1 text-center px-3 py-2 bg-white text-brand-700 rounded-lg text-sm font-bold hover:bg-brand-50 transition">Lapor</a>
            </div>
        </div>
    </div>
</header>

{{-- Navbar text color adjustment on scroll --}}
<script>
    const nb = document.getElementById('navbar');
    const brandTxt = document.getElementById('nav-brand');
    const subTxt = document.getElementById('nav-sub');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY > 60;
        brandTxt.classList.toggle('text-white', !scrolled);
        brandTxt.classList.toggle('text-brand-700', scrolled);
        subTxt.classList.toggle('text-white/60', !scrolled);
        subTxt.classList.toggle('text-slate-400', scrolled);

        navLinks.forEach(l => {
            l.classList.toggle('text-white/80', !scrolled);
            l.classList.toggle('hover:text-white', !scrolled);
            l.classList.toggle('text-slate-600', scrolled);
            l.classList.toggle('hover:text-brand-700', scrolled);
            l.classList.toggle('hover:bg-white/10', !scrolled);
            l.classList.toggle('hover:bg-brand-50', scrolled);
        });
    });
</script>