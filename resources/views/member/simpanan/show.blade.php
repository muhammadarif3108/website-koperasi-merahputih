<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-semibold">Transaksi #{{ $simpanan->id }}</h3>
                            <p class="text-sm text-gray-600">{{ $simpanan->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            @if($simpanan->status === 'pending')
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Persetujuan
                            </span>
                            @elseif($simpanan->status === 'disetujui')
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Disetujui
                            </span>
                            @else
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Ditolak
                            </span>
                            @endif
                        </div>
                    </div>

                    <hr class="mb-6">

                    <!-- Detail Transaksi -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Transaksi</label>
                            @if($simpanan->jenis_transaksi === 'setor')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Setoran
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                                Penarikan
                            </span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                            <p class="text-2xl font-bold {{ $simpanan->jenis_transaksi === 'setor' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $simpanan->jenis_transaksi === 'setor' ? '+' : '-' }} Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    @if($simpanan->keterangan)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded">{{ $simpanan->keterangan }}</p>
                    </div>
                    @endif

                    <!-- Bukti Transaksi -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Transaksi</label>
                        @if($simpanan->bukti_transaksi)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <img src="{{ asset('storage/' . $simpanan->bukti_transaksi) }}"
                                alt="Bukti Transaksi"
                                class="max-w-full h-auto rounded cursor-pointer hover:opacity-90 transition"
                                onclick="openImageModal(this.src)">
                        </div>
                        @else
                        <p class="text-gray-500 text-sm">Tidak ada bukti transaksi</p>
                        @endif
                    </div>

                    <!-- Status Detail -->
                    @if($simpanan->status === 'disetujui')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-green-800">Transaksi Disetujui</h4>
                                <p class="text-sm text-green-700 mt-1">
                                    Disetujui pada {{ $simpanan->approved_at->format('d F Y, H:i') }}
                                </p>
                                @if($simpanan->approver)
                                <p class="text-sm text-green-700">Oleh: {{ $simpanan->approver->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @elseif($simpanan->status === 'ditolak')
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-red-800">Transaksi Ditolak</h4>
                                <p class="text-sm text-red-700 mt-1">
                                    <strong>Alasan:</strong> {{ $simpanan->alasan_penolakan }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @elseif($simpanan->status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-yellow-800">Menunggu Persetujuan</h4>
                                <p class="text-sm text-yellow-700 mt-1">
                                    Transaksi Anda sedang dalam proses verifikasi oleh admin
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Back Button -->
                    <div class="flex justify-end">
                        <a href="{{ route('member.simpanan.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300 transition">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
        <div class="relative max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="Bukti Transaksi" class="max-w-full max-h-screen rounded">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <script>
        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</x-app-layout>