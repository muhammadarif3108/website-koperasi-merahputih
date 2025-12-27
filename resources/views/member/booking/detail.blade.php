<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Booking #{{ $booking->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <!-- Status -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Booking</label>

                        @if($booking->status === 'pending')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pending - Menunggu Konfirmasi
                        </span>
                        @elseif($booking->status === 'disetujui')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Disetujui - Siap Diambil
                        </span>
                        @elseif($booking->status === 'berlangsung')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Sedang Berlangsung
                        </span>
                        @elseif($booking->status === 'selesai')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Selesai
                        </span>
                        @else
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Dibatalkan
                        </span>
                        @endif
                    </div>

                    <!-- Equipment Info -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Alat</h3>

                        <div class="flex gap-4">
                            @if($booking->equipment->image)
                            <img src="{{ asset('storage/' . $booking->equipment->image) }}"
                                class="w-32 h-32 object-cover rounded"
                                alt="{{ $booking->equipment->name }}">
                            @else
                            <div class="w-32 h-32 bg-green-200 rounded flex items-center justify-center">
                                <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            @endif

                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 text-lg">{{ $booking->equipment->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ ucfirst(str_replace('_', ' ', $booking->equipment->category)) }}
                                </p>

                                <div class="mt-3 space-y-1 text-sm">
                                    <p class="text-gray-600">Harga: Rp {{ number_format($booking->price_per_day, 0, ',', '.') }}/hari</p>
                                    <p class="text-gray-600">Durasi: {{ $booking->duration_days }} hari</p>
                                    <p class="text-lg font-bold text-blue-600 mt-2">
                                        Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Schedule -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Jadwal Sewa</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <p class="text-green-800 font-medium mb-1">Tanggal Mulai</p>
                                <p class="text-green-900 text-lg font-bold">
                                    {{ $booking->booking_date->format('d F Y') }}
                                </p>
                            </div>

                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <p class="text-red-800 font-medium mb-1">Tanggal Pengembalian</p>
                                <p class="text-red-900 text-lg font-bold">
                                    {{ $booking->return_date->format('d F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Bukti Pembayaran</h3>

                        @if($booking->bukti_pembayaran)
                        <img src="{{ asset('storage/' . $booking->bukti_pembayaran) }}"
                            class="max-w-md rounded-lg border shadow-sm mb-2">

                        <p class="text-sm text-green-600 font-medium">✓ Bukti pembayaran sudah diupload</p>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                            <p class="text-yellow-800 mb-2">Silakan upload bukti pembayaran.</p>
                            <p class="text-sm text-yellow-700">Total: <strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong></p>
                        </div>

                        <form method="POST" action="{{ route('member.booking.payment', $booking) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="bukti_pembayaran" required
                                class="block w-full text-sm text-gray-600 mb-3">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Upload Bukti
                            </button>
                        </form>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('member.booking.my-bookings') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>