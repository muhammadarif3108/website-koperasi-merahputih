<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Surat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Surat</h3>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-1">
                                    @if($surat->status === 'pending')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending - Menunggu Review
                                    </span>
                                    @elseif($surat->status === 'disetujui')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                    @else
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Surat</label>
                                <p class="mt-1 text-gray-900">{{ $surat->jenis_surat }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keperluan</label>
                                <p class="mt-1 text-gray-900">{{ $surat->keperluan }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <p class="mt-1 text-gray-900">{{ $surat->deskripsi }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
                                <p class="mt-1 text-gray-900">{{ $surat->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>

                            @if($surat->status === 'ditolak' && $surat->alasan_penolakan)
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-red-800 mb-2">Alasan Penolakan</label>
                                <p class="text-red-700">{{ $surat->alasan_penolakan }}</p>
                            </div>
                            @endif

                            @if($surat->status === 'disetujui' && $surat->file_surat)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-green-800 mb-2">File Surat</label>
                                <p class="text-green-700 mb-3">Surat Anda sudah disetujui dan dapat diunduh.</p>
                                <a href="{{ route('member.surat.download', $surat) }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download Surat
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('member.surat.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>