<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Marketplace
            </h2>
            <a href="{{ route('member.orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Lihat Pesanan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($products->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada produk</h3>
                <p class="mt-1 text-sm text-gray-500">Produk akan segera tersedia.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition duration-300">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>

                        @if($product->description)
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $product->description }}</p>
                        @endif

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">
                                Stok: <span class="font-semibold">{{ $product->stock }}</span>
                            </span>
                            @if($product->stock > 0)
                            <span class="text-xs text-green-600 font-medium">Tersedia</span>
                            @else
                            <span class="text-xs text-red-600 font-medium">Habis</span>
                            @endif
                        </div>

                        <a href="{{ route('member.marketplace.show', $product) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-app-layout>