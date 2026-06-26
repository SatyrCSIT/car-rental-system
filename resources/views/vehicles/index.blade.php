<x-layout title="รายการรถให้เช่า">
    <div class="max-w-6xl mx-auto px-4 py-8">
        {{-- หัวข้อ --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">เลือกรถที่ใช่สำหรับคุณ</h1>
            <p class="text-gray-500 mt-2">รถให้เช่าหลากหลายประเภท ในราคาที่คุ้มค่า</p>
        </div>

        {{-- แถบฟิลเตอร์ (ส่งแบบ GET -> ค่า type ไปอยู่ใน query string) --}}
        <form method="GET"
            class="bg-white rounded-xl shadow-sm p-4 mb-8 flex flex-col sm:flex-row sm:items-center gap-3">
            <label for="type" class="text-sm font-medium text-gray-600 whitespace-nowrap">ประเภทรถ</label>
            <select name="type" id="type" onchange="this.form.submit()"
                class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <option value="">ทุกประเภท</option>
                @foreach ($types as $type)
                    {{-- @selected: ใส่ selected ให้ option ที่ตรงกับที่เลือกไว้ --}}
                    <option value="{{ $type->id }}" @selected($selectedType === $type->id)>{{ $type->name }}</option>
                @endforeach
            </select>
            <span class="text-sm text-gray-400 whitespace-nowrap">พบ {{ $vehicles->count() }} คัน</span>
        </form>

        {{-- รายการรถ --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($vehicles as $vehicle)
                <div
                    class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-200 overflow-hidden border border-gray-100">
                    {{-- ส่วนรูป (ตอนนี้ยังไม่มีรูปจริง ใช้ gradient + ไอคอนแทน) --}}
                    <div class="h-40 bg-linear-to-br from-blue-500 to-indigo-600 flex items-center justify-center relative">
                        <span class="text-6xl">🚗</span>
                        @if ($vehicle->status === 'available')
                            <span class="absolute top-3 right-3 text-xs font-medium bg-green-500 text-white px-2.5 py-1 rounded-full shadow">ว่าง</span>
                        @else
                            <span class="absolute top-3 right-3 text-xs font-medium bg-gray-700 text-white px-2.5 py-1 rounded-full shadow">ไม่ว่าง</span>
                        @endif
                    </div>

                    {{-- รายละเอียด --}}
                    <div class="p-5">
                        <p class="text-xs text-blue-500 font-medium">{{ $vehicle->vehicleType->name }}</p>
                        <h2 class="text-lg font-bold text-gray-800 mt-1">{{ $vehicle->brand }} {{ $vehicle->model }}</h2>

                        <div class="mt-4 flex items-end justify-between">
                            <div>
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($vehicle->daily_rate) }}</span>
                                <span class="text-sm text-gray-400">฿ / วัน</span>
                            </div>
                            @if ($vehicle->status === 'available')
                                {{-- TODO: เชื่อมไปหน้าจองในขั้นถัดไป --}}
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                                    เช่าคันนี้
                                </button>
                            @else
                                <button disabled
                                    class="bg-gray-200 text-gray-400 text-sm font-medium px-4 py-2 rounded-lg cursor-not-allowed">
                                    ไม่ว่าง
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                {{-- กรณีกรองแล้วไม่เจอรถ --}}
                <div class="col-span-full text-center py-16 text-gray-400">
                    <p class="text-5xl mb-3">🔍</p>
                    <p>ไม่พบรถในประเภทที่เลือก</p>
                    <a href="{{ route('vehicles.index') }}" class="text-blue-600 hover:underline text-sm mt-2 inline-block">
                        ดูรถทั้งหมด
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
