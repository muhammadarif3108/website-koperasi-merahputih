<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pesanan #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Status -->
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

                    <!-- Product Info -->
                    <div class="border-b pb-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Produk</h3>
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
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $order->product->name }}</h4>
                                <p class="text-sm text-gray-600">{{ $order->quantity }} x Rp {{ number_format($order->product->price, 0, ',', '.') }}</p>
                                <p class="text-lg font-bold text-blue-600 mt-1">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Proof -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Bukti Pembayaran</h3>

                        @if($order->bukti_pembayaran)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="max-w-md rounded-lg border">
                        </div>
                        <p class="text-sm text-green-600 font-medium">✓ Bukti pembayaran sudah diupload</p>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                            <p class="text-yellow-800 mb-3">Silakan upload bukti pembayaran Anda untuk melanjutkan pesanan.</p>
                            <p class="text-sm text-yellow-700 mb-2">Transfer ke rekening:</p>
                            <div class="bg-white rounded p-3 text-sm">
                                <p class="font-semibold">Bank BCA - 1234567890</p>
                                <p>a.n. Koperasi Merah Putih</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('member.orders.payment', $order) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Bukti Transfer
                                </label>
                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                                @error('bukti_pembayaran')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Upload Bukti
                            </button>
                        </form>
                        @endif
                    </div>

                    <!-- Order Info -->
                    <div class="border-t pt-6">
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
                                <span class="text-gray-600">Pemesan:</span>
                                <span class="font-medium">{{ $order->user->name }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('member.orders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>