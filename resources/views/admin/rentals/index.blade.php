<x-admin-layout title="การจองทั้งหมด">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">การจองทั้งหมด</h1>
            <p class="text-slate-500 text-sm">เปลี่ยนสถานะการเช่า — ตั้งเป็น "เสร็จสิ้น" หรือ "ยกเลิก" เพื่อคืนรถให้ว่าง</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-left">
                        <tr>
                            <th class="px-4 py-3 font-medium">ลูกค้า</th>
                            <th class="px-4 py-3 font-medium">รถ</th>
                            <th class="px-4 py-3 font-medium">ช่วงเวลา</th>
                            <th class="px-4 py-3 font-medium">ราคารวม</th>
                            <th class="px-4 py-3 font-medium">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($rentals as $rental)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3">
                                    <div class="font-semibold text-slate-800">{{ $rental->user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $rental->user->phone }}</div>
                                </td>
                                <td class="px-4 py-3 text-slate-700">
                                    {{ $rental->vehicle->brand }} {{ $rental->vehicle->model }}
                                    <div class="text-xs text-slate-400">{{ $rental->vehicle->vehicleType->name }}</div>
                                </td>
                                <td class="px-4 py-3 text-slate-500">
                                    {{ $rental->start_date->format('d/m/Y') }} → {{ $rental->end_date->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 font-semibold text-slate-800">{{ number_format($rental->total_price) }} ฿</td>
                                <td class="px-4 py-3">
                                    <form method="POST" action="{{ route('admin.rentals.status', $rental) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="rounded-lg border border-slate-200 px-2 py-1.5 text-xs focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                            @foreach (['pending' => 'รอยืนยัน', 'confirmed' => 'ยืนยันแล้ว', 'active' => 'กำลังเช่า', 'completed' => 'เสร็จสิ้น', 'cancelled' => 'ยกเลิก'] as $value => $label)
                                                <option value="{{ $value }}" @selected($rental->status === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-slate-400">ยังไม่มีการจอง</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
