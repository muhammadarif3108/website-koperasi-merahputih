<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Setor Simpanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Info Rekening -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="font-semibold text-blue-900 mb-2">Informasi Transfer</h3>
                        <p class="text-sm text-blue-800 mb-2">Silakan transfer ke rekening berikut:</p>
                        <div class="bg-white rounded p-3">
                            <p class="font-semibold text-gray-900">Bank BCA</p>
                            <p class="text-gray-900">No. Rekening: <span class="font-mono font-bold">1234567890</span></p>
                            <p class="text-gray-900">a.n. <span class="font-semibold">Koperasi Merah Putih</span></p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('member.simpanan.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="nominal" class="block text-sm font-medium text-gray-700 mb-2">Nominal Setoran</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="nominal" id="nominal" value="{{ old('nominal') }}" min="10000" step="1000"
                                    class="pl-12 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="0" required>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Minimal setoran Rp 10.000</p>
                            @error('nominal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="bukti_transfer" class="block text-sm font-medium text-gray-700 mb-2">
                                Bukti Transfer
                            </label>
                            <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                            <p class="mt-1 text-xs text-gray-500">Upload foto/screenshot bukti transfer (Max 2MB)</p>
                            @error('bukti_transfer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('member.simpanan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Ajukan Setoran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>