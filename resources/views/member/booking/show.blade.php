<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Alat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Equipment Image -->
                        <div>
                            @if($equipment->image)
                            <img src="{{ asset('storage/' . $equipment->image) }}" alt="{{ $equipment->name }}" class="w-full rounded-lg shadow-md">
                            @else
                            <div class="w-full h-96 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            @endif
                        </div>

                        <!-- Equipment Details -->
                        <div>
                            <div class="mb-4">
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst(str_replace('_', ' ', $equipment->category)) }}
                                </span>
                            </div>

                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $equipment->name }}</h1>

                            <div class="mb-6">
                                <span class="text-4xl font-bold text-blue-600">
                                    Rp {{ number_format($equipment->price_per_day, 0, ',', '.') }}
                                </span>
                                <span class="text-xl text-gray-600">/hari</span>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center">
                                    <span class="text-gray-700 font-medium mr-2">Ketersediaan:</span>
                                    <span class="text-lg font-semibold {{ $equipment->available_stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $equipment->available_stock }} unit tersedia
                                    </span>
                                </div>
                            </div>

                            @if($equipment->description)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $equipment->description }}</p>
                            </div>
                            @endif

                            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-900 mb-2">Informasi Penting:</h4>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li>• Booking minimal 1 hari</li>
                                    <li>• Pembayaran dilakukan setelah booking dikonfirmasi</li>
                                    <li>• Alat harus dikembalikan sesuai tanggal yang dijadwalkan</li>
                                    <li>• Kerusakan alat menjadi tanggung jawab penyewa</li>
                                </ul>
                            </div>

                            <!-- Booking Button -->
                            @if($equipment->available_stock > 0)
                            <div class="flex gap-4">
                                <a href="{{ route('member.booking.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-4 rounded text-center">
                                    Kembali
                                </a>
                                <a href="{{ route('member.booking.create', $equipment) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded text-center">
                                    Booking Sekarang
                                </a>
                            </div>
                            @else
                            <div class="mt-8">
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                    <p class="text-red-800">Maaf, alat ini sedang tidak tersedia.</p>
                                </div>
                                <a href="{{ route('member.booking.index') }}" class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-4 rounded text-center">
                                    Kembali
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>