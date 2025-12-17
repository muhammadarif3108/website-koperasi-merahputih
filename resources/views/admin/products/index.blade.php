<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Produk
            </h2>
            <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($products->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada produk</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan produk baru.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                + Tambah Produk
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($products as $product)
                        <div class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
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

                                <div class="mb-3">
                                    <span class="text-xl font-bold text-blue-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm text-gray-500">
                                        Stok: <span class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $product->stock }}</span>
                                    </span>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-3 rounded text-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded text-sm">
                                            Hapus
                                        </button>
                                    </form>
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