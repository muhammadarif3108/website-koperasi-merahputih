<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Alat Pertanian
            </h2>
            <a href="{{ route('admin.equipment.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Alat
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($equipment->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada alat</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan alat pertanian baru.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.equipment.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                + Tambah Alat
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($equipment as $item)
                        <div class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                            @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                            @else
                            <div class="w-full h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            @endif

                            <div class="p-4">
                                <div class="mb-2">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ ucfirst(str_replace('_', ' ', $item->category)) }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->name }}</h3>

                                @if($item->description)
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $item->description }}</p>
                                @endif

                                <div class="mb-3">
                                    <span class="text-xl font-bold text-blue-600">
                                        Rp {{ number_format($item->price_per_day, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-600">/hari</span>
                                </div>

                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm text-gray-500">
                                        Stok: <span class="font-semibold {{ $item->stock > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $item->stock }}</span>
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        Tersedia: <span class="font-semibold">{{ $item->available_stock }}</span>
                                    </span>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('admin.equipment.edit', $item) }}" class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-3 rounded text-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.equipment.destroy', $item) }}" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus alat ini?')">
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