<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
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
                                        Pending
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

                            <!-- Anggota Info -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h4 class="font-semibold text-sm text-gray-700 mb-3">Informasi Anggota</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500">Nama</p>
                                        <p class="text-sm font-medium">{{ $simpanan->user->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Email</p>
                                        <p class="text-sm font-medium">{{ $simpanan->user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Telepon</p>
                                        <p class="text-sm font-medium">{{ $simpanan->user->phone ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Saldo Saat Ini</p>
                                        <p class="text-sm font-bold text-blue-600">Rp {{ number_format($simpanan->user->saldo_simpanan, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Transaksi -->
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between items-center pb-3 border-b">
                                    <span class="text-sm text-gray-600">Jenis Transaksi</span>
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

                                <div class="flex justify-between items-center pb-3 border-b">
                                    <span class="text-sm text-gray-600">Jumlah</span>
                                    <span class="text-2xl font-bold {{ $simpanan->jenis_transaksi === 'setor' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $simpanan->jenis_transaksi === 'setor' ? '+' : '-' }} Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}
                                    </span>
                                </div>

                                @if($simpanan->keterangan)
                                <div class="pb-3 border-b">
                                    <span class="text-sm text-gray-600 block mb-2">Keterangan</span>
                                    <p class="text-sm bg-gray-50 p-3 rounded">{{ $simpanan->keterangan }}</p>
                                </div>
                                @endif
                            </div>

                            <!-- Bukti Transaksi -->
                            <div class="mb-6">
                                <h4 class="font-semibold text-sm text-gray-700 mb-3">Bukti Transaksi</h4>
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

                            <!-- Status History -->
                            @if($simpanan->status !== 'pending')
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-sm text-gray-700 mb-3">Riwayat Status</h4>
                                @if($simpanan->status === 'disetujui')
                                <div class="flex items-start text-sm">
                                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-green-800">Transaksi Disetujui</p>
                                        <p class="text-gray-600">{{ $simpanan->approved_at?->format('d F Y, H:i') }}</p>
                                        @if($simpanan->approver)
                                        <p class="text-gray-600">Oleh: {{ $simpanan->approver->name }}</p>
                                        @endif
                                    </div>
                                </div>
                                @else
                                <div class="flex items-start text-sm">
                                    <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-red-800">Transaksi Ditolak</p>
                                        <p class="text-gray-600 mt-1"><strong>Alasan:</strong> {{ $simpanan->alasan_penolakan }}</p>
                                        @if($simpanan->approver)
                                        <p class="text-gray-600 mt-1">Oleh: {{ $simpanan->approver->name }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar Actions -->
                <div class="lg:col-span-1">
                    @if($simpanan->status === 'pending')
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6">
                            <h4 class="font-semibold mb-4">Tindakan</h4>

                            <!-- Approve Button -->
                            <form action="{{ route('admin.simpanan.approve', $simpanan) }}" method="POST" class="mb-3">
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui transaksi ini?')"
                                    class="w-full bg-green-600 text-white px-4 py-3 rounded-md hover:bg-green-700 transition font-semibold">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Setujui Transaksi
                                </button>
                            </form>

                            <!-- Reject Button -->
                            <button onclick="openRejectModal()"
                                class="w-full bg-red-600 text-white px-4 py-3 rounded-md hover:bg-red-700 transition font-semibold">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tolak Transaksi
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- Back Button -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <a href="{{ route('admin.simpanan.index') }}"
                                class="block w-full bg-gray-200 text-gray-700 px-4 py-3 rounded-md hover:bg-gray-300 transition text-center font-semibold">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Tolak Transaksi</h3>
            <form action="{{ route('admin.simpanan.reject', $simpanan) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alasan_penolakan" id="alasan_penolakan" rows="4"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                        placeholder="Masukkan alasan penolakan..." required></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                        Tolak
                    </button>
                    <button type="button" onclick="closeRejectModal()" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                        Batal
                    </button>
                </div>
            </form>
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
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</x-app-layout>