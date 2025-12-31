<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Merah Putih</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <h1 class="text-2xl font-bold">
                    <span class="text-red-700">Koperasi</span>
                    <span class="text-gray-800">Merah Putih</span>
                </h1>

                <div class="flex items-center gap-4">
                    @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-red-600 font-medium">Dashboard</a>
                    @else
                    <a href="{{ route('member.dashboard') }}" class="text-gray-700 hover:text-red-600 font-medium">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-600 font-medium hover:underline">Logout</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold">
                        Daftar
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="bg-red-700 text-white py-20">
        <div class="max-w-7xl mx-auto text-center px-4">
            <h2 class="text-5xl font-bold mb-6">Koperasi Merah Putih</h2>
            <p class="text-lg mb-3">Sistem digital terpadu untuk masyarakat desa</p>
            <p class="mb-8 text-red-100"></p>

            @guest
            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-white text-red-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-100">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white py-3 px-8 rounded-lg hover:bg-white hover:text-red-600">
                    Login
                </a>
            </div>
            @else
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('member.dashboard') }}"
                class="bg-white text-red-600 font-bold py-3 px-8 rounded-lg">
                Masuk Dashboard
            </a>
            @endguest
        </div>
    </section>

    <!-- Layanan -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900">Layanan Koperasi</h3>
                <p class="text-gray-600">Solusi terpadu untuk kebutuhan warga desa</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl shadow hover:shadow-lg">
                    <div class="bg-red-100 w-16 h-16 flex items-center justify-center rounded-full mb-6">
                        <span class="text-red-600 text-2xl font-bold">📄</span>
                    </div>
                    <h4 class="font-bold text-xl mb-2">E-Surat Desa</h4>
                    <p class="text-gray-600">Pengurusan surat cepat tanpa harus datang ke kantor desa.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow hover:shadow-lg">
                    <div class="bg-red-100 w-16 h-16 flex items-center justify-center rounded-full mb-6">
                        <span class="text-red-600 text-2xl font-bold">🛒</span>
                    </div>
                    <h4 class="font-bold text-xl mb-2">Toko Koperasi</h4>
                    <p class="text-gray-600">Belanja kebutuhan harian & pertanian harga anggota.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow hover:shadow-lg">
                    <div class="bg-red-100 w-16 h-16 flex items-center justify-center rounded-full mb-6">
                        <span class="text-red-600 text-2xl font-bold">🚜</span>
                    </div>
                    <h4 class="font-bold text-xl mb-2">Sewa Alat</h4>
                    <p class="text-gray-600">Alat pertanian modern untuk meningkatkan hasil panen.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8">
            <div>
                <h4 class="text-white font-bold mb-3">Koperasi Merah Putih</h4>
                <p class="text-sm">Bersama membangun desa mandiri dan sejahtera.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-3">Layanan</h4>
                <ul class="space-y-2 text-sm">
                    <li>E-Surat</li>
                    <li>Toko Koperasi</li>
                    <li>Sewa Alat</li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-3">Kontak</h4>
                <p class="text-sm">Kantor Koperasi Desa</p>
                <p class="text-sm">Senin – Jumat</p>
            </div>
        </div>

        <div class="text-center text-gray-500 text-sm mt-8">
            © 2024 Koperasi Merah Putih
        </div>
    </footer>

</body>

</html>