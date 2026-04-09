<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        // Redirect jika sudah login
        if (Auth::check()) {
            return redirect()->intended($this->redirectPath());
        }

        return view('content-auth.content-login');
    }

    /**
     * Proses login dengan validasi lengkap.
     */
    public function login(Request $request): RedirectResponse
    {
        // 1. Validasi input
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        // 2. Cek rate limiting (max 5 percobaan per menit)
        $this->ensureIsNotRateLimited($request);

        // 3. Coba autentikasi
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi yang Anda masukkan salah.',
            ]);
        }

        // 4. Reset rate limiter setelah berhasil login
        RateLimiter::clear($this->throttleKey($request));

        // 5. Cek status akun (kolom is_active)
        $user = Auth::user();

        if (!$user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Akun Anda dinonaktifkan. Hubungi administrator.',
            ]);
        }

        // 6. Regenerate session untuk keamanan (hindari session fixation)
        $request->session()->regenerate();

        // 7. Redirect berdasarkan role
        return redirect()->intended($this->redirectPath($user->role));
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil keluar dari sistem.');
    }

    /**
     * Tentukan halaman redirect berdasarkan role.
     */
    protected function redirectPath(?string $role = null): string
    {
        return match ($role) {
            'admin' => route('admin.dashboard'),
            'user' => route('user.dashboard'),
            default => route('dashboard'),
        };
    }

    /**
     * Pastikan request belum melebihi batas percobaan login.
     *
     * @throws ValidationException
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
        ]);
    }

    /**
     * Buat throttle key unik per email + IP.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(
            Str::lower($request->input('email')) . '|' . $request->ip()
        );
    }
}