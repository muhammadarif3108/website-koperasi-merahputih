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
                    <!-- Status Badge -->
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

                    <!-- Customer Info -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Pemesan</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <label class="font-medium text-gray-700">Nama:</label>
                                <p class="mt-1">{{ $booking->user->name }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Email:</label>
                                <p class="mt-1">{{ $booking->user->email }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Telepon:</label>
                                <p class="mt-1">{{ $booking->user->phone ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Alamat:</label>
                                <p class="mt-1">{{ $booking->user->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Equipment Info -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Alat</h3>
                        <div class="flex gap-4">
                            @if($booking->equipment->image)
                            <img src="{{ asset('storage/' . $booking->equipment->image) }}" alt="{{ $booking->equipment->name }}" class="w-32 h-32 object-cover rounded">
                            @else
                            <div class="w-32 h-32 bg-green-200 rounded flex items-center justify-center">
                                <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            @endif
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 text-lg">{{ $booking->equipment->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ ucfirst(str_replace('_', ' ', $booking->equipment->category)) }}</p>
                                <div class="mt-3 space-y-1 text-sm">
                                    <p class="text-gray-600">Harga: Rp {{ number_format($booking->price_per_day, 0, ',', '.') }}/hari</p>
                                    <p class="text-gray-600">Durasi: {{ $booking->duration_days }} hari</p>
                                    <p class="text-lg font-bold text-blue-600 mt-2">Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Schedule -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Jadwal Sewa</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <p class="text-green-800 font-medium mb-1">Tanggal Mulai</p>
                                <p class="text-green-900 text-lg font-bold">{{ $booking->booking_date->format('d F Y') }}</p>
                            </div>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <p class="text-red-800 font-medium mb-1">Tanggal Pengembalian</p>
                                <p class="text-red-900 text-lg font-bold">{{ $booking->return_date->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Proof -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Bukti Pembayaran</h3>
                        @if($booking->bukti_pembayaran)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $booking->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="max-w-md rounded-lg border shadow-sm">
                        </div>
                        <p class="text-sm text-green-600 font-medium">✓ Bukti pembayaran telah diupload</p>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-yellow-800">⚠ Pembeli belum mengupload bukti pembayaran</p>
                        </div>
                        @endif
                    </div>

                    <!-- Booking Info -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Booking</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">ID Booking:</span>
                                <span class="font-medium">#{{ $booking->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Booking:</span>
                                <span class="font-medium">{{ $booking->created_at->format('d F Y, H:i') }} WIB</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="font-medium">{{ ucfirst($booking->status) }}</span>
                            </div>
                            @if($booking->approved_at)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Disetujui Pada:</span>
                                <span class="font-medium">{{ $booking->approved_at->format('d F Y, H:i') }} WIB</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Form -->
                    @if($booking->status !== 'selesai' && $booking->status !== 'dibatalkan')
                    <div class="bg-gray-50 border rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Update Status Booking</h3>

                        @if($booking->status === 'pending' && $booking->bukti_pembayaran)
                        <!-- Approve/Reject untuk Pending dengan bukti -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Approve Form -->
                            <div class="border rounded-lg p-4 bg-green-50">
                                <h4 class="font-semibold text-green-900 mb-3">Setujui Booking</h4>
                                <form method="POST" action="{{ route('admin.bookings.approve', $booking) }}">
                                    @csrf
                                    <div class="bg-white rounded p-3 mb-4 text-sm">
                                        <p class="text-gray-700 mb-2"><strong>Konfirmasi:</strong></p>
                                        <p class="text-gray-600">• Alat: {{ $booking->equipment->name }}</p>
                                        <p class="text-gray-600">• Durasi: {{ $booking->duration_days }} hari</p>
                                        <p class="text-green-600 font-semibold">• Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menyetujui booking ini?')">
                                        Setujui Booking
                                    </button>
                                </form>
                            </div>

                            <!-- Reject Form -->
                            <div class="border rounded-lg p-4 bg-red-50">
                                <h4 class="font-semibold text-red-900 mb-3">Tolak Booking</h4>
                                <form method="POST" action="{{ route('admin.bookings.reject', $booking) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                                        <textarea name="keterangan" rows="4" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                            placeholder="Jelaskan alasan penolakan (contoh: bukti pembayaran tidak valid, dll)"></textarea>
                                    </div>
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menolak booking ini?')">
                                        Tolak Booking
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <!-- Update Status untuk yang sudah approved -->
                        <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Pilih Status Baru</label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="disetujui" {{ $booking->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="berlangsung" {{ $booking->status === 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                                    <option value="selesai" {{ $booking->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ $booking->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded p-3 mb-4 text-sm text-blue-800">
                                <strong>Panduan Status:</strong>
                                <ul class="mt-2 space-y-1">
                                    <li>• <strong>Disetujui:</strong> Booking dikonfirmasi, alat siap diambil</li>
                                    <li>• <strong>Berlangsung:</strong> Alat sudah diambil dan sedang digunakan</li>
                                    <li>• <strong>Selesai:</strong> Alat sudah dikembalikan</li>
                                    <li>• <strong>Dibatalkan:</strong> Booking dibatalkan</li>
                                </ul>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Status
                            </button>
                        </form>
                        @endif
                    </div>
                    @endif

                    @if($booking->keterangan)
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <label class="block text-sm font-medium text-red-800 mb-2">Keterangan/Alasan Pembatalan</label>
                        <p class="text-red-700">{{ $booking->keterangan }}</p>
                    </div>
                    @endif

                    <div class="flex justify-end">
                        <a href="{{ route('admin.bookings.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>