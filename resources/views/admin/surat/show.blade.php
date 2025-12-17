<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Review Surat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Pengaju</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <label class="font-medium text-gray-700">Nama:</label>
                                <p>{{ $surat->user->name }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Email:</label>
                                <p>{{ $surat->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Surat</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block font-medium text-gray-700">Jenis Surat</label>
                                <p class="mt-1">{{ $surat->jenis_surat }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-gray-700">Keperluan</label>
                                <p class="mt-1">{{ $surat->keperluan }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-gray-700">Deskripsi</label>
                                <p class="mt-1">{{ $surat->deskripsi }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-gray-700">Status</label>
                                <span class="mt-1 px-3 py-1 inline-flex text-sm rounded-full 
                                    {{ $surat->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $surat->status === 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $surat->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($surat->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($surat->status === 'pending')
                    <div class="border-t pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Approve Form -->
                            <div class="border rounded-lg p-4 bg-green-50">
                                <h4 class="font-semibold text-green-900 mb-3">Setujui Surat</h4>
                                <form method="POST" action="{{ route('admin.surat.approve', $surat) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload File Surat (PDF)</label>
                                        <input type="file" name="file_surat" accept=".pdf" required
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                        <p class="text-xs text-gray-500 mt-1">Max 5MB</p>
                                    </div>
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Setujui
                                    </button>
                                </form>
                            </div>

                            <!-- Reject Form -->
                            <div class="border rounded-lg p-4 bg-red-50">
                                <h4 class="font-semibold text-red-900 mb-3">Tolak Surat</h4>
                                <form method="POST" action="{{ route('admin.surat.reject', $surat) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                                        <textarea name="alasan_penolakan" rows="3" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                            placeholder="Jelaskan alasan penolakan..."></textarea>
                                    </div>
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.surat.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>