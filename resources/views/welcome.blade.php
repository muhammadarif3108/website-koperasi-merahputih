<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Merah Putih</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-4xl mx-auto text-center px-4">
            <!-- Logo -->
            <div class="mb-8">
                <h1 class="text-6xl font-bold">
                    <span class="text-red-600">Koperasi</span>
                    <span class="text-gray-800">Merah Putih</span>
                </h1>
                <p class="mt-4 text-xl text-gray-600">Sistem Informasi Koperasi Terpadu</p>
            </div>

            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-lg shadow">
                    <svg class="w-12 h-12 mx-auto mb-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="font-semibold text-lg mb-2">E-Surat</h3>
                    <p class="text-sm text-gray-600">Pengajuan surat online dengan mudah dan cepat</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <svg class="w-12 h-12 mx-auto mb-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <h3 class="font-semibold text-lg mb-2">Marketplace</h3>
                    <p class="text-sm text-gray-600">Belanja produk koperasi secara online</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <svg class="w-12 h-12 mx-auto mb-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="font-semibold text-lg mb-2">Simpanan</h3>
                    <p class="text-sm text-gray-600">Kelola simpanan Anda dengan aman</p>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex gap-4 justify-center">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('member.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200">
                            Dashboard Anggota
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-50 text-blue-600 font-bold py-3 px-8 rounded-lg border-2 border-blue-600 transition duration-200">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Info -->
            <div class="mt-12 text-sm text-gray-500">
                <p>Sudah punya akun? Login dengan kredensial berikut untuk testing:</p>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto">
                    <div class="bg-red-50 p-4 rounded border border-red-200">
                        <p class="font-semibold text-red-800">Admin</p>
                        <p class="text-xs mt-1">admin@koperasi.com / password</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded border border-blue-200">
                        <p class="font-semibold text-blue-800">Member</p>
                        <p class="text-xs mt-1">budi@member.com / password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>