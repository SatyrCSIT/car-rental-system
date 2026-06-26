<x-layout title="จองรถ {{ $vehicle->brand }} {{ $vehicle->model }}">
    <div class="max-w-4xl mx-auto px-4 py-10">
        <a href="{{ route('vehicles.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-indigo-600 mb-6">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            กลับไปหน้ารถทั้งหมด
        </a>

        <div class="grid md:grid-cols-5 gap-6">
            {{-- สรุปรถ --}}
            <div class="md:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden h-fit">
                <div class="h-40 bg-linear-to-br from-indigo-500 to-indigo-700 flex items-center justify-center">
                    <svg class="w-20 h-20 text-white/90" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                    </svg>
                </div>
                <div class="p-5">
                    <span class="text-xs text-indigo-600 font-semibold">{{ $vehicle->vehicleType->name }}</span>
                    <h2 class="text-xl font-bold text-slate-900 mt-1">{{ $vehicle->brand }} {{ $vehicle->model }}</h2>
                    <p class="text-sm text-slate-400 mt-1">ทะเบียน {{ $vehicle->license_plate }}</p>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <span class="text-2xl font-extrabold text-slate-900">{{ number_format($vehicle->daily_rate) }}</span>
                        <span class="text-sm text-slate-400">฿ / วัน</span>
                    </div>
                </div>
            </div>

            {{-- ฟอร์มจอง --}}
            <div class="md:col-span-3 bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-900 mb-4">เลือกวันที่เช่า</h2>

                <form method="POST" action="{{ route('rentals.store', $vehicle) }}" id="bookingForm"
                    data-rate="{{ $vehicle->daily_rate }}" class="space-y-4">
                    @csrf {{-- กัน CSRF (กฎ 4) --}}

                    <div>
                        <label for="start_date" class="block text-sm font-medium text-slate-600 mb-1">วันที่รับรถ</label>
                        <input type="date" name="start_date" id="start_date" required
                            min="{{ now()->toDateString() }}" value="{{ old('start_date', now()->toDateString()) }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                        @error('start_date') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-slate-600 mb-1">วันที่คืนรถ</label>
                        <input type="date" name="end_date" id="end_date" required
                            min="{{ now()->addDay()->toDateString() }}" value="{{ old('end_date', now()->addDay()->toDateString()) }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                        @error('end_date') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- สรุปราคา (preview ด้วย JS — server คำนวณจริงอีกที) --}}
                    <div class="bg-slate-50 rounded-xl p-4 flex items-center justify-between">
                        <div class="text-sm text-slate-500">
                            จำนวน <span id="previewDays" class="font-semibold text-slate-700">-</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-slate-400">รวมทั้งหมด</span>
                            <div id="previewTotal" class="text-2xl font-extrabold text-indigo-600">-</div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">
                        ยืนยันการจอง
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- คำนวณราคาแบบ live (progressive enhancement) --}}
    <script>
        (function () {
            const form = document.getElementById('bookingForm');
            const rate = parseFloat(form.dataset.rate);
            const start = document.getElementById('start_date');
            const end = document.getElementById('end_date');
            const daysEl = document.getElementById('previewDays');
            const totalEl = document.getElementById('previewTotal');

            function update() {
                const s = new Date(start.value);
                const e = new Date(end.value);
                if (start.value && end.value && e > s) {
                    const days = Math.round((e - s) / 86400000);
                    daysEl.textContent = days + ' วัน';
                    totalEl.textContent = (days * rate).toLocaleString('th-TH') + ' ฿';
                } else {
                    daysEl.textContent = '-';
                    totalEl.textContent = '-';
                }
            }

            start.addEventListener('change', update);
            end.addEventListener('change', update);
            update();
        })();
    </script>
</x-layout>
