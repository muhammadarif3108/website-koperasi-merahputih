<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pesanan Saya
            </h2>
            <a href="{{ route('member.marketplace.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Belanja Lagi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($orders->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pesanan</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai belanja di marketplace kami.</p>
                        <div class="mt-6">
                            <a href="{{ route('member.marketplace.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Lihat Produk
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="space-y-4">
                        @foreach($orders as $order)
                        <div class="border rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-4 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $order->product->name }}</h3>
                                        @if($order->status === 'pending')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                        @elseif($order->status === 'diproses')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Diproses
                                        </span>
                                        @elseif($order->status === 'selesai')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                        @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Dibatalkan
                                        </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-3">
                                        <div>
                                            <span class="font-medium">Jumlah:</span> {{ $order->quantity }} item
                                        </div>
                                        <div>
                                            <span class="font-medium">Total:</span> Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Tanggal:</span> {{ $order->created_at->format('d M Y') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Bukti:</span>
                                            @if($order->bukti_pembayaran)
                                            <span class="text-green-600">✓ Sudah diupload</span>
                                            @else
                                            <span class="text-red-600">Belum diupload</span>
                                            @endif
                                        </div>
                                    </div>

                                    @if(!$order->bukti_pembayaran && $order->status === 'pending')
                                    <div class="bg-yellow-50 border border-yellow-200 rounded p-2 text-sm text-yellow-800">
                                        ⚠ Silakan upload bukti pembayaran untuk melanjutkan pesanan
                                    </div>
                                    @endif
                                </div>

                                <div class="ml-4">
                                    <a href="{{ route('member.orders.show', $order) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
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