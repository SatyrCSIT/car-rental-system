<x-admin-layout title="จัดการรถ">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">จัดการรถ</h1>
                <p class="text-slate-500 text-sm">เพิ่ม แก้ไข เปลี่ยนสถานะ หรือลบรถ</p>
            </div>
            <a href="{{ route('admin.vehicles.create') }}"
                class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                เพิ่มรถ
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-left">
                        <tr>
                            <th class="px-4 py-3 font-medium">รถ</th>
                            <th class="px-4 py-3 font-medium">ประเภท</th>
                            <th class="px-4 py-3 font-medium">ทะเบียน</th>
                            <th class="px-4 py-3 font-medium">ราคา/วัน</th>
                            <th class="px-4 py-3 font-medium">สถานะ</th>
                            <th class="px-4 py-3 font-medium text-right">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($vehicles as $vehicle)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        @if ($vehicle->image_path)
                                            <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="" class="w-12 h-9 object-cover rounded-md border border-slate-200">
                                        @else
                                            <span class="w-12 h-9 rounded-md bg-slate-100 flex items-center justify-center text-slate-400">
                                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" /></svg>
                                            </span>
                                        @endif
                                        <span class="font-semibold text-slate-800">{{ $vehicle->brand }} {{ $vehicle->model }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-slate-500">{{ $vehicle->vehicleType->name }}</td>
                                <td class="px-4 py-3 text-slate-500">{{ $vehicle->license_plate }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ number_format($vehicle->daily_rate) }} ฿</td>
                                <td class="px-4 py-3">
                                    <form method="POST" action="{{ route('admin.vehicles.status', $vehicle) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="rounded-lg border border-slate-200 px-2 py-1.5 text-xs focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                            <option value="available" @selected($vehicle->status === 'available')>ว่าง</option>
                                            <option value="rented" @selected($vehicle->status === 'rented')>ไม่ว่าง</option>
                                            <option value="maintenance" @selected($vehicle->status === 'maintenance')>ซ่อมบำรุง</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">แก้ไข</a>
                                        <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}"
                                            onsubmit="return confirm('ยืนยันการลบรถ {{ $vehicle->brand }} {{ $vehicle->model }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium">ลบ</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-slate-400">ยังไม่มีรถในระบบ</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
