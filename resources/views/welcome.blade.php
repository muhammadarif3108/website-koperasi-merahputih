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
    <section class="bg-gradient-to-br from-red-700 via-red-600 to-red-800 text-white py-20">
        <div class="max-w-7xl mx-auto text-center px-4">
            <h2 class="text-5xl font-bold mb-6">Koperasi Merah Putih</h2>
            <p class="text-xl mb-3">Sistem Digital Terpadu untuk Kesejahteraan Masyarakat</p>
            <p class="mb-8 text-red-100">Simpanan, Belanja Kebutuhan, dan Sewa Alat Pertanian dalam Satu Platform</p>

            @guest
            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-white text-red-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white py-3 px-8 rounded-lg hover:bg-white hover:text-red-600 transition">
                    Login
                </a>
            </div>
            @else
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('member.dashboard') }}"
                class="inline-block bg-white text-red-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition">
                Masuk Dashboard
            </a>
            @endguest
        </div>
    </section>

    <!-- Layanan -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-2">Layanan Koperasi</h3>
                <p class="text-gray-600">Solusi terpadu untuk kebutuhan anggota koperasi</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Simpanan -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-xl shadow hover:shadow-xl transition">
                    <div class="bg-blue-600 w-16 h-16 flex items-center justify-center rounded-full mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Simpanan Anggota</h4>
                    <p class="text-gray-600 mb-4">Kelola simpanan dengan mudah. Setoran dan penarikan kapan saja dengan proses persetujuan yang cepat.</p>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Setoran & penarikan online
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Cek saldo real-time
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Riwayat transaksi lengkap
                        </li>
                    </ul>
                </div>

                <!-- Toko Koperasi -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-xl shadow hover:shadow-xl transition">
                    <div class="bg-green-600 w-16 h-16 flex items-center justify-center rounded-full mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Toko Koperasi</h4>
                    <p class="text-gray-600 mb-4">Belanja kebutuhan harian dan pertanian dengan harga khusus anggota koperasi.</p>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Harga terbaik
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Produk berkualitas
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Pesanan mudah & cepat
                        </li>
                    </ul>
                </div>

                <!-- Sewa Alat -->
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 rounded-xl shadow hover:shadow-xl transition">
                    <div class="bg-yellow-600 w-16 h-16 flex items-center justify-center rounded-full mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Sewa Alat Pertanian</h4>
                    <p class="text-gray-600 mb-4">Akses alat pertanian modern untuk meningkatkan produktivitas hasil panen.</p>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Traktor & mesin panen
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Harga sewa terjangkau
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Booking online praktis
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-2">Keunggulan Platform</h3>
                <p class="text-gray-600">Mengapa memilih Koperasi Merah Putih</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                <div class="text-center p-6">
                    <div class="bg-red-100 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Aman & Terpercaya</h4>
                    <p class="text-sm text-gray-600">Data transaksi terenkripsi dengan sistem keamanan terbaik</p>
                </div>

                <div class="text-center p-6">
                    <div class="bg-red-100 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Proses Cepat</h4>
                    <p class="text-sm text-gray-600">Verifikasi dan persetujuan dalam waktu singkat</p>
                </div>

                <div class="text-center p-6">
                    <div class="bg-red-100 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Akses 24/7</h4>
                    <p class="text-sm text-gray-600">Layanan dapat diakses kapan saja dan dimana saja</p>
                </div>

                <div class="text-center p-6">
                    <div class="bg-red-100 w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Komunitas Solid</h4>
                    <p class="text-sm text-gray-600">Bergabung dengan ribuan anggota koperasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-red-700 text-white py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h3 class="text-3xl font-bold mb-4">Siap Bergabung dengan Koperasi Merah Putih?</h3>
            <p class="text-lg mb-8">Nikmati kemudahan layanan digital untuk meningkatkan kesejahteraan Anda</p>
            @guest
            <a href="{{ route('register') }}" class="inline-block bg-white text-red-600 font-bold py-3 px-10 rounded-lg hover:bg-gray-100 transition text-lg">
                Daftar Menjadi Anggota
            </a>
            @else
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('member.dashboard') }}"
                class="inline-block bg-white text-red-600 font-bold py-3 px-10 rounded-lg hover:bg-gray-100 transition text-lg">
                Masuk ke Dashboard
            </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8">
            <div>
                <h4 class="text-white font-bold mb-3 text-lg">Koperasi Merah Putih</h4>
                <p class="text-sm">Platform digital terpadu untuk kesejahteraan anggota koperasi.</p>
                <p class="text-sm mt-2">Bersama membangun ekonomi yang lebih baik.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-3 text-lg">Layanan Kami</h4>
                <ul class="space-y-2 text-sm">
                    <li class="hover:text-white transition cursor-pointer">💰 Simpanan Anggota</li>
                    <li class="hover:text-white transition cursor-pointer">🛒 Toko Koperasi</li>
                    <li class="hover:text-white transition cursor-pointer">🚜 Sewa Alat Pertanian</li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-3 text-lg">Kontak</h4>
                <p class="text-sm">📍 Kantor Koperasi Desa</p>
                <p class="text-sm">📞 (021) 123-4567</p>
                <p class="text-sm">✉️ info@koperasimerahputih.id</p>
                <p class="text-sm mt-2">⏰ Senin – Jumat, 08.00 - 16.00</p>
            </div>
        </div>

        <div class="text-center text-gray-500 text-sm mt-8 pt-8 border-t border-gray-800">
            © 2025 Koperasi Merah Putih. All rights reserved.
        </div>
    </footer>

</body>

</html>