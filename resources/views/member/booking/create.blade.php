<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Alat - {{ $equipment->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <!-- Equipment Summary -->
                    <div class="bg-gray-50 border rounded-lg p-4 mb-6">
                        <div class="flex gap-4">
                            @if($equipment->image)
                            <img src="{{ asset('storage/' . $equipment->image) }}" class="w-24 h-24 object-cover rounded">
                            @else
                            <div class="w-24 h-24 bg-green-200 rounded flex items-center justify-center">
                                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            @endif

                            <div>
                                <h3 class="font-semibold text-gray-900 text-lg">{{ $equipment->name }}</h3>
                                <p class="text-gray-600 text-sm mt-1">{{ ucfirst(str_replace('_', ' ', $equipment->category)) }}</p>
                                <p class="text-blue-600 font-bold mt-2">
                                    Rp {{ number_format($equipment->price_per_day, 0, ',', '.') }} /hari
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <form method="POST" action="{{ route('member.booking.store', $equipment) }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" id="booking_date" name="booking_date"
                                class="w-full rounded-md border-gray-300"
                                min="{{ date('Y-m-d') }}" required onchange="calculateTotal()">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengembalian</label>
                            <input type="date" id="return_date" name="return_date"
                                class="w-full rounded-md border-gray-300"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required onchange="calculateTotal()">
                        </div>

                        <div id="calculationSummary" class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6" style="display:none;">
                            <h4 class="font-semibold text-blue-900 mb-3">Ringkasan Biaya</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Durasi:</span>
                                    <span id="duration" class="font-semibold"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Harga per hari:</span>
                                    <span class="font-semibold">Rp {{ number_format($equipment->price_per_day, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t pt-2 mt-2 flex justify-between">
                                    <span class="font-semibold">Total:</span>
                                    <span id="totalPrice" class="font-bold text-blue-700"></span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('member.booking.show', $equipment) }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Buat Booking
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        const pricePerDay = {
            {
                $equipment - > price_per_day
            }
        };

        function calculateTotal() {
            const start = document.getElementById('booking_date').value;
            const end = document.getElementById('return_date').value;

            if (!start || !end) return;

            const startDate = new Date(start);
            const endDate = new Date(end);

            if (endDate <= startDate) {
                document.getElementById('calculationSummary').style.display = 'none';
                return;
            }

            const diffTime = endDate - startDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

            document.getElementById('duration').innerText = diffDays + ' hari';
            document.getElementById('totalPrice').innerText = 'Rp ' + (diffDays * pricePerDay).toLocaleString('id-ID');
            document.getElementById('calculationSummary').style.display = 'block';
        }
    </script>
</x-app-layout>