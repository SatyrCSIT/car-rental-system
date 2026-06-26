<x-admin-layout title="จัดการรถ">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">จัดการรถ</h1>
            <p class="text-slate-500 text-sm">เปลี่ยนสถานะ หรือลบรถออกจากระบบ</p>
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
                                <td class="px-4 py-3 font-semibold text-slate-800">{{ $vehicle->brand }} {{ $vehicle->model }}</td>
                                <td class="px-4 py-3 text-slate-500">{{ $vehicle->vehicleType->name }}</td>
                                <td class="px-4 py-3 text-slate-500">{{ $vehicle->license_plate }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ number_format($vehicle->daily_rate) }} ฿</td>
                                <td class="px-4 py-3">
                                    {{-- เปลี่ยนสถานะ: form PATCH ส่งอัตโนมัติเมื่อเลือก --}}
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
                                <td class="px-4 py-3 text-right">
                                    <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}"
                                        onsubmit="return confirm('ยืนยันการลบรถ {{ $vehicle->brand }} {{ $vehicle->model }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium">ลบ</button>
                                    </form>
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
