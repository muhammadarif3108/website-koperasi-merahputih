<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Simpanan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Ajukan Transaksi Simpanan</h3>
                        <p class="text-sm text-gray-600 mt-1">Isi formulir di bawah untuk mengajukan setoran atau penarikan simpanan</p>
                    </div>

                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('member.simpanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Jenis Transaksi -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Transaksi</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 hover:border-blue-500 focus:outline-none">
                                    <input type="radio" name="jenis_transaksi" value="setor" class="sr-only" required>
                                    <div class="flex flex-1">
                                        <div class="flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Setoran</span>
                                            <span class="mt-1 flex items-center text-sm text-gray-500">Menambah saldo simpanan</span>
                                        </div>
                                    </div>
                                    <svg class="h-5 w-5 text-blue-600 hidden" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </label>

                                <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 hover:border-blue-500 focus:outline-none">
                                    <input type="radio" name="jenis_transaksi" value="tarik" class="sr-only" required>
                                    <div class="flex flex-1">
                                        <div class="flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Penarikan</span>
                                            <span class="mt-1 flex items-center text-sm text-gray-500">Mengurangi saldo simpanan</span>
                                        </div>
                                    </div>
                                    <svg class="h-5 w-5 text-blue-600 hidden" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-6">
                            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah (Minimal Rp 10.000)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                                <input type="number" name="jumlah" id="jumlah"
                                    class="pl-12 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('jumlah') }}"
                                    min="10000"
                                    step="1000"
                                    required>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Saldo saat ini: Rp {{ number_format(auth()->user()->saldo_simpanan, 0, ',', '.') }}</p>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-6">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                                Keterangan (Opsional)
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Tuliskan keterangan transaksi...">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Bukti Transaksi -->
                        <div class="mb-6" id="bukti-transaksi-section">
                            <label for="bukti_transaksi" class="block text-sm font-medium text-gray-700 mb-2">
                                Bukti Transfer <span class="text-red-500" id="required-badge">*</span>
                            </label>
                            <input type="file" name="bukti_transaksi" id="bukti_transaksi"
                                class="w-full border border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring-blue-500"
                                accept="image/*">
                            <p class="mt-1 text-xs text-gray-500" id="upload-hint">Format: JPG, PNG, JPEG (Maks. 2MB) - Wajib untuk setoran</p>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6" id="info-box">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Informasi Penting</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc list-inside space-y-1" id="info-list">
                                            <li>Transaksi akan diproses setelah disetujui admin</li>
                                            <li id="bukti-info">Upload bukti transfer yang jelas (hanya untuk setoran)</li>
                                            <li>Untuk penarikan, pastikan saldo mencukupi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition font-semibold">
                                Ajukan Transaksi
                            </button>
                            <a href="{{ route('member.simpanan.index') }}" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition text-center font-semibold">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Radio button selection visual feedback and form logic
        document.querySelectorAll('input[name="jenis_transaksi"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('input[name="jenis_transaksi"]').forEach(r => {
                    const label = r.closest('label');
                    const checkmark = label.querySelector('svg');
                    if (r.checked) {
                        label.classList.add('border-blue-500', 'bg-blue-50');
                        checkmark.classList.remove('hidden');
                    } else {
                        label.classList.remove('border-blue-500', 'bg-blue-50');
                        checkmark.classList.add('hidden');
                    }
                });

                // Update form based on transaction type
                const fileInput = document.getElementById('bukti_transaksi');
                const requiredBadge = document.getElementById('required-badge');
                const uploadHint = document.getElementById('upload-hint');
                const buktiInfo = document.getElementById('bukti-info');

                if (this.value === 'setor') {
                    // Setoran - bukti wajib
                    fileInput.required = true;
                    requiredBadge.classList.remove('hidden');
                    uploadHint.textContent = 'Format: JPG, PNG, JPEG (Maks. 2MB) - Wajib untuk setoran';
                    uploadHint.classList.remove('text-gray-500');
                    uploadHint.classList.add('text-red-500');
                    buktiInfo.textContent = 'Upload bukti transfer yang jelas (wajib untuk setoran)';
                } else {
                    // Penarikan - bukti opsional
                    fileInput.required = false;
                    requiredBadge.classList.add('hidden');
                    uploadHint.textContent = 'Format: JPG, PNG, JPEG (Maks. 2MB) - Opsional untuk penarikan';
                    uploadHint.classList.remove('text-red-500');
                    uploadHint.classList.add('text-gray-500');
                    buktiInfo.textContent = 'Untuk penarikan, bukti transfer tidak diperlukan';
                }
            });
        });

        // File preview
        document.getElementById('bukti_transaksi').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB');
                    this.value = '';
                }
            }
        });
    </script>
</x-app-layout>