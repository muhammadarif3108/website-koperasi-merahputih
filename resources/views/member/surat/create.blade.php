<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajukan Surat Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('member.surat.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                            <select name="jenis_surat" id="jenis_surat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">Pilih Jenis Surat</option>
                                <option value="Surat Keterangan Usaha" {{ old('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                                <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                                <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                                <option value="Surat Keterangan Penghasilan" {{ old('jenis_surat') == 'Surat Keterangan Penghasilan' ? 'selected' : '' }}>Surat Keterangan Penghasilan</option>
                                <option value="Surat Pengantar" {{ old('jenis_surat') == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                                <option value="Lainnya" {{ old('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-2">Keperluan</label>
                            <input type="text" name="keperluan" id="keperluan" value="{{ old('keperluan') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Mengurus KTP, Melamar Pekerjaan, dll" required>
                            @error('keperluan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan detail keperluan surat Anda" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('member.surat.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Ajukan Surat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>