<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pesanan #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Status Badge -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Pesanan</label>
                        @if($order->status === 'pending')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pending - Menunggu Konfirmasi
                        </span>
                        @elseif($order->status === 'diproses')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Sedang Diproses
                        </span>
                        @elseif($order->status === 'selesai')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
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
                                <p class="mt-1">{{ $order->user->name }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Email:</label>
                                <p class="mt-1">{{ $order->user->email }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Telepon:</label>
                                <p class="mt-1">{{ $order->user->phone ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Alamat:</label>
                                <p class="mt-1">{{ $order->user->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Produk</h3>
                        <div class="flex gap-4">
                            @if($order->product->image)
                            <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="w-24 h-24 object-cover rounded">
                            @else
                            <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 text-lg">{{ $order->product->name }}</h4>
                                <div class="mt-2 space-y-1 text-sm">
                                    <p class="text-gray-600">Harga Satuan: Rp {{ number_format($order->product->price, 0, ',', '.') }}</p>
                                    <p class="text-gray-600">Jumlah: {{ $order->quantity }} item</p>
                                    <p class="text-lg font-bold text-blue-600 mt-2">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Proof -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Bukti Pembayaran</h3>
                        @if($order->bukti_pembayaran)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="max-w-md rounded-lg border shadow-sm">
                        </div>
                        <p class="text-sm text-green-600 font-medium">✓ Bukti pembayaran telah diupload</p>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-yellow-800">⚠ Pembeli belum mengupload bukti pembayaran</p>
                        </div>
                        @endif
                    </div>

                    <!-- Order Info -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Pesanan</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">ID Pesanan:</span>
                                <span class="font-medium">#{{ $order->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Pesan:</span>
                                <span class="font-medium">{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="font-medium">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Form -->
                    @if($order->status !== 'selesai' && $order->status !== 'dibatalkan')
                    <div class="bg-gray-50 border rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Update Status Pesanan</h3>
                        <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Pilih Status Baru</label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            @if($order->bukti_pembayaran)
                            <div class="bg-blue-50 border border-blue-200 rounded p-3 mb-4 text-sm text-blue-800">
                                <strong>Catatan:</strong> Jika status diubah ke "Selesai", stok produk akan otomatis berkurang sebanyak {{ $order->quantity }} item.
                            </div>
                            @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded p-3 mb-4 text-sm text-yellow-800">
                                <strong>Perhatian:</strong> Pembeli belum mengupload bukti pembayaran. Pastikan pembayaran sudah diterima sebelum memproses pesanan.
                            </div>
                            @endif

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Status
                            </button>
                        </form>
                    </div>
                    @endif

                    <div class="flex justify-end">
                        <a href="{{ route('admin.orders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>