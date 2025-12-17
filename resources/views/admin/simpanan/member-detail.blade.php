<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Simpanan - {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Member Info Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informasi Anggota</h3>
                            <div class="space-y-2">
                                <div>
                                    <label class="text-sm text-gray-600">Nama:</label>
                                    <p class="font-medium">{{ $user->name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-600">Email:</label>
                                    <p class="font-medium">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-600">Telepon:</label>
                                    <p class="font-medium">{{ $user->phone ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-600">Alamat:</label>
                                    <p class="font-medium">{{ $user->address ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Ringkasan Simpanan</h3>
                            <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-lg p-6">
                                <p class="text-sm text-green-800 mb-2">Total Saldo Simpanan</p>
                                <p class="text-3xl font-bold text-green-900">Rp {{ number_format($user->saldo_simpanan, 0, ',', '.') }}</p>
                                <p class="text-sm text-green-700 mt-2">Total {{ $riwayat->count() }} transaksi berhasil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>

                    @if($riwayat->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada riwayat transaksi</h3>
                        <p class="mt-1 text-sm text-gray-500">Anggota ini belum pernah melakukan setoran yang disetujui.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Setoran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Disetujui</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                $totalSetor = 0;
                                @endphp
                                @foreach($riwayat as $index => $item)
                                @php
                                $totalSetor += $item->nominal;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->approved_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">
                                        + Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        Setoran Simpanan
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="bg-gray-50 font-bold">
                                    <td colspan="3" class="px-6 py-4 text-sm text-gray-900 text-right">Total Setoran:</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                        Rp {{ number_format($totalSetor, 0, ',', '.') }}
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm text-blue-800">
                            <strong>Informasi:</strong> Total setoran yang disetujui adalah
                            <span class="font-bold">Rp {{ number_format($totalSetor, 0, ',', '.') }}</span>
                            yang sama dengan saldo simpanan saat ini.
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('admin.simpanan.members') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>