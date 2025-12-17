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

                <!-- Simpanan Pending -->
                <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Simpanan Pending</p>
                            <h3 class="text-3xl font-bold mt-2">{{ \App\Models\Simpanan::where('status', 'pending')->count() }}</h3>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <a href="{{ route('admin.simpanan.index') }}" class="mt-4 inline-block text-sm hover:underline">
                        Lihat Semua →
                    </a>
                </div>
            </div>

            <!-- Quick Access -->
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

                <!-- Recent Orders -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold mb-4">Pesanan Terbaru</h4>
                        <div class="space-y-3">
                            @forelse(\App\Models\Order::with(['user', 'product'])->latest()->take(5)->get() as $order)
                            <div class="flex items-center justify-between border-b pb-2">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $order->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $order->product->name }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $order->status === 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            @empty
                            <p class="text-sm text-gray-500">Belum ada pesanan</p>
                            @endforelse
                        </div>
                        <a href="{{ route('admin.orders.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:text-blue-800">
                            Lihat Semua →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>