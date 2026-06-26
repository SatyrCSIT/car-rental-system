<x-layout title="การจองของฉัน">
    <div class="max-w-5xl mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold text-slate-900 mb-6">การจองของฉัน</h1>

        @forelse ($rentals as $rental)
            @php
                // map สถานะ -> [ป้ายภาษาไทย, สี]
                $statusMap = [
                    'pending' => ['รอยืนยัน', 'bg-amber-100 text-amber-700'],
                    'confirmed' => ['ยืนยันแล้ว', 'bg-emerald-100 text-emerald-700'],
                    'active' => ['กำลังเช่า', 'bg-indigo-100 text-indigo-700'],
                    'completed' => ['เสร็จสิ้น', 'bg-slate-200 text-slate-600'],
                    'cancelled' => ['ยกเลิก', 'bg-rose-100 text-rose-700'],
                ];
                [$statusLabel, $statusClass] = $statusMap[$rental->status] ?? ['-', 'bg-slate-100 text-slate-600'];
            @endphp

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-4 flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-linear-to-br from-indigo-500 to-indigo-700 flex items-center justify-center shrink-0">
                    <svg class="w-8 h-8 text-white/90" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h3 class="font-bold text-slate-900">{{ $rental->vehicle->brand }} {{ $rental->vehicle->model }}</h3>
                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $statusClass }}">{{ $statusLabel }}</span>
                    </div>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ $rental->vehicle->vehicleType->name }} ·
                        {{ $rental->start_date->format('d/m/Y') }} → {{ $rental->end_date->format('d/m/Y') }}
                    </p>
                </div>

                <div class="text-right">
                    <span class="text-xs text-slate-400">ราคารวม</span>
                    <div class="text-xl font-extrabold text-slate-900">{{ number_format($rental->total_price) }} ฿</div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm text-center py-16">
                <div class="text-6xl mb-4">🗓️</div>
                <p class="text-slate-500">คุณยังไม่มีรายการจอง</p>
                <a href="{{ route('vehicles.index') }}"
                    class="inline-block mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-xl transition">
                    เลือกรถเลย
                </a>
            </div>
        @endforelse
    </div>
</x-layout>
