<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Anggota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">Ini adalah dashboard Koperasi Merah Putih</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Saldo Simpanan -->
                <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Saldo Simpanan</p>
                            <h3 class="text-2xl font-bold mt-2">Rp {{ number_format(Auth::user()->saldo_simpanan, 0, ',', '.') }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <a href="{{ route('member.simpanan.index') }}" class="mt-4 inline-block text-sm hover:underline">
                        Kelola Simpanan →
                    </a>
                </div>

                <!-- Total Booking -->
                <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Total Booking Alat</p>
                            <h3 class="text-3xl font-bold mt-2">{{ Auth::user()->bookings->count() }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <a href="{{ route('member.booking.my-bookings') }}" class="mt-4 inline-block text-sm hover:underline">
                        Lihat Detail →
                    </a>
                </div>

                <!-- Total Simpanan Transaksi -->
                <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Transaksi Simpanan</p>
                            <h3 class="text-3xl font-bold mt-2">{{ Auth::user()->simpanan->count() }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <a href="{{ route('member.simpanan.index') }}" class="mt-4 inline-block text-sm hover:underline">
                        Lihat Semua →
                    </a>
                </div>

                <!-- Total Pesanan -->
                <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Total Pesanan</p>
                            <h3 class="text-3xl font-bold mt-2">{{ Auth::user()->orders->count() }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z" />
                        </svg>
                    </div>
                    <a href="{{ route('member.orders.index') }}" class="mt-4 inline-block text-sm hover:underline">
                        Lihat Riwayat →
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold mb-4">Aksi Cepat</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('member.simpanan.create') }}" class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <svg class="w-8 h-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-medium">Transaksi Simpanan</span>
                        </a>

                        <a href="{{ route('member.marketplace.index') }}" class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <svg class="w-8 h-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span class="text-sm font-medium">Belanja Produk</span>
                        </a>

                        <a href="{{ route('member.booking.index') }}" class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                            <svg class="w-8 h-8 text-yellow-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="text-sm font-medium">Sewa Alat</span>
                        </a>

                        <a href="{{ route('member.booking.my-bookings') }}" class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <svg class="w-8 h-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-medium">Riwayat Booking</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Recent Simpanan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold">Transaksi Simpanan Terbaru</h4>
                            <a href="{{ route('member.simpanan.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                        </div>
                        @if(Auth::user()->simpanan->count() > 0)
                        <div class="space-y-3">
                            @foreach(Auth::user()->simpanan->take(5) as $item)
                            <div class="flex justify-between items-center py-2 border-b">
                                <div>
                                    <span class="text-sm font-medium">
                                        @if($item->jenis_transaksi === 'setor')
                                        <span class="text-green-600">Setoran</span>
                                        @else
                                        <span class="text-red-600">Penarikan</span>
                                        @endif
                                    </span>
                                    <p class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold {{ $item->jenis_transaksi === 'setor' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $item->jenis_transaksi === 'setor' ? '+' : '-' }} Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </p>
                                    <span class="text-xs px-2 py-1 rounded-full {{ $item->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($item->status === 'disetujui' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada transaksi simpanan</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold">Booking Terbaru</h4>
                            <a href="{{ route('member.booking.my-bookings') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                        </div>
                        @if(Auth::user()->bookings->count() > 0)
                        <div class="space-y-3">
                            @foreach(Auth::user()->bookings->take(5) as $booking)
                            <div class="flex justify-between items-center py-2 border-b">
                                <div>
                                    <p class="text-sm font-medium">{{ $booking->equipment->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->booking_date->format('d/m/Y') }} - {{ $booking->return_date->format('d/m/Y') }}</p>
                                </div>
                                <span class="text-xs px-2 py-1 rounded-full {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($booking->status === 'disetujui' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada booking</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>