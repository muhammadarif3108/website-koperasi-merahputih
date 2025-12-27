<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Review Setoran Simpanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Member Info -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Anggota</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm bg-gray-50 p-4 rounded">
                            <div>
                                <label class="font-medium text-gray-700">Nama:</label>
                                <p class="mt-1">{{ $simpanan->user->name }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Email:</label>
                                <p class="mt-1">{{ $simpanan->user->email }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Saldo Saat Ini:</label>
                                <p class="mt-1 text-green-600 font-bold">Rp {{ number_format($simpanan->user->saldo_simpanan, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <label class="font-medium text-gray-700">Total Setoran Disetujui:</label>
                                <p class="mt-1 font-medium">{{ $simpanan->user->simpanan->where('status', 'disetujui')->count() }} kali</p>
                            </div>
                        </div>
                    </div>

                    <!-- Deposit Details -->
                    <div class="border-t pt-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Setoran</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                @if($simpanan->status === 'pending')
                                <span class="mt-1 px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending - Menunggu Review
                                </span>
                                @elseif($simpanan->status === 'disetujui')
                                <span class="mt-1 px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                                @else
                                <span class="mt-1 px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nominal Setoran</label>
                                <p class="mt-1 text-2xl font-bold text-blue-600">Rp {{ number_format($simpanan->nominal, 0, ',', '.') }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
                                <p class="mt-1">{{ $simpanan->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Transfer</label>
                                <img src="{{ asset('storage/' . $simpanan->bukti_transfer) }}" alt="Bukti Transfer" class="max-w-md rounded-lg border shadow-sm">
                            </div>

                            @if($simpanan->status === 'disetujui')
                            <div class="bg-green-50 border border-green-200 rounded p-4">
                                <label class="block text-sm font-medium text-green-800 mb-1">Disetujui Pada</label>
                                <p class="text-green-700">{{ $simpanan->approved_at->format('d F Y, H:i') }} WIB</p>
                            </div>
                            @endif

                            @if($simpanan->status === 'ditolak' && $simpanan->keterangan)
                            <div class="bg-red-50 border border-red-200 rounded p-4">
                                <label class="block text-sm font-medium text-red-800 mb-2">Alasan Penolakan</label>
                                <p class="text-red-700">{{ $simpanan->keterangan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($simpanan->status === 'pending')
                    <div class="border-t pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Approve Form -->
                            <div class="border rounded-lg p-4 bg-green-50">
                                <h4 class="font-semibold text-green-900 mb-3">Setujui Setoran</h4>
                                <form method="POST" action="{{ route('admin.simpanan.approve', $simpanan) }}">
                                    @csrf
                                    <div class="bg-white rounded p-3 mb-4 text-sm">
                                        <p class="text-gray-700 mb-2"><strong>Konfirmasi:</strong></p>
                                        <p class="text-gray-600">• Nominal: Rp {{ number_format($simpanan->nominal, 0, ',', '.') }}</p>
                                        <p class="text-gray-600">• Saldo sekarang: Rp {{ number_format($simpanan->user->saldo_simpanan, 0, ',', '.') }}</p>
                                        <p class="text-green-600 font-semibold">• Saldo setelah disetujui: Rp {{ number_format($simpanan->user->saldo_simpanan + $simpanan->nominal, 0, ',', '.') }}</p>
                                    </div>
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menyetujui setoran ini?')">
                                        Setujui Setoran
                                    </button>
                                </form>
                            </div>

                            <!-- Reject Form -->
                            <div class="border rounded-lg p-4 bg-red-50">
                                <h4 class="font-semibold text-red-900 mb-3">Tolak Setoran</h4>
                                <form method="POST" action="{{ route('admin.simpanan.reject', $simpanan) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                                        <textarea name="keterangan" rows="4" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                            placeholder="Jelaskan alasan penolakan (contoh: bukti transfer tidak valid, nominal tidak sesuai, dll)"></textarea>
                                    </div>
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menolak setoran ini?')">
                                        Tolak Setoran
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.simpanan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>