<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div>
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-md">
                            @else
                            <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                            <div class="mb-6">
                                <span class="text-4xl font-bold text-blue-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center">
                                    <span class="text-gray-700 font-medium mr-2">Stok:</span>
                                    <span class="text-lg font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock }} {{ $product->stock > 0 ? 'tersedia' : '(Habis)' }}
                                    </span>
                                </div>
                            </div>

                            @if($product->description)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                            </div>
                            @endif

                            <!-- Order Form -->
                            @if($product->stock > 0)
                            <form method="POST" action="{{ route('member.marketplace.order', $product) }}" class="mt-8">
                                @csrf
                                <div class="mb-4">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jumlah
                                    </label>
                                    <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @error('quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex gap-4">
                                    <a href="{{ route('member.marketplace.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-4 rounded text-center">
                                        Kembali
                                    </a>
                                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">
                                        Pesan Sekarang
                                    </button>
                                </div>
                            </form>
                            @else
                            <div class="mt-8">
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                    <p class="text-red-800">Maaf, produk ini sedang habis.</p>
                                </div>
                                <a href="{{ route('member.marketplace.index') }}" class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-4 rounded text-center">
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