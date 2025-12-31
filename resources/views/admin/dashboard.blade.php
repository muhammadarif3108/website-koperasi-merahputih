<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">Dashboard Admin Koperasi Merah Putih</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Anggota -->
                <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Total Anggota</p>
                            <h3 class="text-3xl font-bold mt-2">{{ \App\Models\User::where('role', 'member')->count() }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                    </div>
                </div>

                <!-- Surat Pending -->
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Surat Pending</p>
                            <h3 class="text-3xl font-bold mt-2">{{ \App\Models\Surat::where('status', 'pending')->count() }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <a href="{{ route('admin.surat.index') }}" class="mt-4 inline-block text-sm hover:underline">
                        Lihat Semua →
                    </a>
                </div>

                <!-- Pesanan Baru -->
                <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Pesanan Baru</p>
                            <h3 class="text-3xl font-bold mt-2">{{ \App\Models\Order::where('status', 'pending')->count() }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z" />
                        </svg>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="mt-4 inline-block text-sm hover:underline">
                        Lihat Semua →
                    </a>
                </div>

                <!-- Booking Pending -->
                <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Booking Pending</p>
                            <h3 class="text-3xl font-bold mt-2">{{ \App\Models\Booking::where('status', 'pending')->count() }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="mt-4 inline-block text-sm hover:underline">
                        Lihat Semua →
                    </a>
                </div>
            </div>

            <!-- CRUD Management Section -->
            <div class="mb-6">
                <h4 class="text-xl font-semibold mb-4">Manajemen Data</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Kelola Produk Marketplace -->
                    <a href="{{ route('admin.products.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-lg transition duration-300 border-l-4 border-purple-500">
                        <div class="flex items-center justify-between mb-4">
                            <svg class="w-10 h-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2 py-1 rounded">
                                {{ \App\Models\Product::count() }} produk
                            </span>
                        </div>
                        <h5 class="font-semibold text-lg mb-1">Produk Marketplace</h5>
                        <p class="text-sm text-gray-600 mb-3">Kelola produk yang dijual di marketplace</p>
                        <div class="flex items-center text-purple-600 text-sm font-medium">
                            <span>Kelola Produk</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>

                    <!-- Kelola Alat Pertanian -->
                    <a href="{{ route('admin.equipment.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-lg transition duration-300 border-l-4 border-green-500">
                        <div class="flex items-center justify-between mb-4">
                            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">
                                {{ \App\Models\Equipment::count() }} alat
                            </span>
                        </div>
                        <h5 class="font-semibold text-lg mb-1">Alat Pertanian</h5>
                        <p class="text-sm text-gray-600 mb-3">Kelola alat yang tersedia untuk disewa</p>
                        <div class="flex items-center text-green-600 text-sm font-medium">
                            <span>Kelola Alat</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>

                    <!-- Kelola Anggota -->
                    <a href="{{ route('admin.members.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-lg transition duration-300 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between mb-4">
                            <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">
                                {{ \App\Models\User::where('role', 'member')->count() }} anggota
                            </span>
                        </div>
                        <h5 class="font-semibold text-lg mb-1">Data Anggota</h5>
                        <p class="text-sm text-gray-600 mb-3">Kelola data anggota koperasi</p>
                        <div class="flex items-center text-blue-600 text-sm font-medium">
                            <span>Kelola Anggota</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>

                    <!-- Kelola Surat -->
                    <a href="{{ route('admin.surat.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-lg transition duration-300 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between mb-4">
                            <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">
                                {{ \App\Models\Surat::where('status', 'pending')->count() }} pending
                            </span>
                        </div>
                        <h5 class="font-semibold text-lg mb-1">E-Surat</h5>
                        <p class="text-sm text-gray-600 mb-3">Review dan kelola pengajuan surat</p>
                        <div class="flex items-center text-yellow-600 text-sm font-medium">
                            <span>Kelola Surat</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-6">
                <h4 class="text-xl font-semibold mb-4">Tambah Data Baru</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.products.create') }}" class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                        <svg class="w-8 h-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-sm font-medium">Tambah Produk</span>
                    </a>

                    <a href="{{ route('admin.equipment.create') }}" class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                        <svg class="w-8 h-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-sm font-medium">Tambah Alat</span>
                    </a>

                    <a href="{{ route('admin.members.create') }}" class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                        <svg class="w-8 h-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-sm font-medium">Tambah Anggota</span>
                    </a>

                    <a href="{{ route('admin.bookings.index') }}" class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                        <svg class="w-8 h-8 text-yellow-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="text-sm font-medium">Kelola Booking</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Recent Surat -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold mb-4">Surat Terbaru</h4>
                        <div class="space-y-3">
                            @forelse(\App\Models\Surat::with('user')->latest()->take(5)->get() as $surat)
                            <div class="flex items-center justify-between border-b pb-2">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $surat->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $surat->jenis_surat }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $surat->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $surat->status === 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $surat->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($surat->status) }}
                                </span>
                            </div>
                            @empty
                            <p class="text-sm text-gray-500">Belum ada surat</p>
                            @endforelse
                        </div>
                        <a href="{{ route('admin.surat.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:text-blue-800">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold mb-4">Booking Terbaru</h4>
                        <div class="space-y-3">
                            @forelse(\App\Models\Booking::with(['user', 'equipment'])->latest()->take(5)->get() as $booking)
                            <div class="flex items-center justify-between border-b pb-2">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->equipment->name }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $booking->status === 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $booking->status === 'berlangsung' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $booking->status === 'selesai' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            @empty
                            <p class="text-sm text-gray-500">Belum ada booking</p>
                            @endforelse
                        </div>
                        <a href="{{ route('admin.bookings.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:text-blue-800">
                            Lihat Semua →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>