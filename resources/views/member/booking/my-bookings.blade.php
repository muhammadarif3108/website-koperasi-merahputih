<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Booking Saya
            </h2>
            <a href="{{ route('member.booking.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Sewa Alat
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-yellow-100 rounded-lg p-4">
                    <p class="text-sm text-yellow-800">Pending</p>
                    <p class="text-2xl font-bold text-yellow-900">{{ $bookings->where('status', 'pending')->count() }}</p>
                </div>
                <div class="bg-green-100 rounded-lg p-4">
                    <p class="text-sm text-green-800">Disetujui</p>
                    <p class="text-2xl font-bold text-green-900">{{ $bookings->where('status', 'disetujui')->count() }}</p>
                </div>
                <div class="bg-blue-100 rounded-lg p-4">
                    <p class="text-sm text-blue-800">Berlangsung</p>
                    <p class="text-2xl font-bold text-blue-900">{{ $bookings->where('status', 'berlangsung')->count() }}</p>
                </div>
                <div class="bg-gray-100 rounded-lg p-4">
                    <p class="text-sm text-gray-800">Selesai</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $bookings->where('status', 'selesai')->count() }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($bookings->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada booking</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menyewa alat pertanian.</p>
                        <div class="mt-6">
                            <a href="{{ route('member.booking.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Sewa Alat
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="space-y-4">
                        @foreach($bookings as $booking)
                        <div class="border rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex gap-4 flex-1">
                                    @if($booking->equipment->image)
                                    <img src="{{ asset('storage/' . $booking->equipment->image) }}" alt="{{ $booking->equipment->name }}" class="w-20 h-20 object-cover rounded">
                                    @else
                                    <div class="w-20 h-20 bg-green-200 rounded flex items-center justify-center">
                                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    @endif

                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $booking->equipment->name }}</h3>
                                            @if($booking->status === 'pending')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                            @elseif($booking->status === 'disetujui')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Disetujui
                                            </span>
                                            @elseif($booking->status === 'berlangsung')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Berlangsung
                                            </span>
                                            @elseif($booking->status === 'selesai')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Selesai
                                            </span>
                                            @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Dibatalkan
                                            </span>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm text-gray-600 mb-3">
                                            <div>
                                                <span class="font-medium">Mulai:</span> {{ $booking->booking_date->format('d M Y') }}
                                            </div>
                                            <div>
                                                <span class="font-medium">Kembali:</span> {{ $booking->return_date->format('d M Y') }}
                                            </div>
                                            <div>
                                                <span class="font-medium">Durasi:</span> {{ $booking->duration_days }} hari
                                            </div>
                                            <div>
                                                <span class="font-medium">Total:</span> <span class="text-blue-600 font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>

                                        @if(!$booking->bukti_pembayaran && $booking->status === 'pending')
                                        <div class="bg-yellow-50 border border-yellow-200 rounded p-2 text-sm text-yellow-800">
                                            ⚠ Silakan upload bukti pembayaran untuk melanjutkan booking
                                        </div>
                                        @endif

                                        @if($booking->bukti_pembayaran && $booking->status === 'pending')
                                        <div class="bg-blue-50 border border-blue-200 rounded p-2 text-sm text-blue-800">
                                            ℹ Menunggu konfirmasi admin
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="ml-4">
                                    <a href="{{ route('member.booking.detail', $booking) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>