<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Setoran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <span class="mt-1 px-3 py-1 inline-flex text-sm rounded-full 
                                {{ $simpanan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $simpanan->status === 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $simpanan->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($simpanan->status) }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nominal</label>
                            <p class="mt-1 text-lg font-semibold">Rp {{ number_format($simpanan->nominal, 0, ',', '.') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bukti Transfer</label>
                            <img src="{{ asset('storage/' . $simpanan->bukti_transfer) }}" alt="Bukti Transfer" class="mt-2 max-w-md rounded border">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
                            <p class="mt-1">{{ $simpanan->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>

                        @if($simpanan->status === 'ditolak' && $simpanan->keterangan)
                        <div class="bg-red-50 border border-red-200 rounded p-4">
                            <label class="block text-sm font-medium text-red-800 mb-2">Alasan Penolakan</label>
                            <p class="text-red-700">{{ $simpanan->keterangan }}</p>
                        </div>
                        @endif

                        @if($simpanan->status === 'disetujui')
                        <div class="bg-green-50 border border-green-200 rounded p-4">
                            <p class="text-green-800">✓ Setoran telah disetujui pada {{ $simpanan->approved_at->format('d F Y, H:i') }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('member.simpanan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>