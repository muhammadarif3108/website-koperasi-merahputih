<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Surat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($surats->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500">Belum ada pengajuan surat</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Anggota</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Surat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keperluan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($surats as $index => $surat)
                                <tr class="{{ $surat->status === 'pending' ? 'bg-yellow-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $surat->user->name }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $surat->jenis_surat }}</td>
                                    <td class="px-6 py-4 text-sm">{{ Str::limit($surat->keperluan, 30) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($surat->status === 'pending')
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @elseif($surat->status === 'disetujui')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                                        @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.surat.show', $surat) }}" class="text-blue-600 hover:text-blue-900">Review</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>