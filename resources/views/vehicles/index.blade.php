<x-layout title="CarRental — เช่ารถง่าย ๆ ในที่เดียว">
    {{-- ===== HERO ===== --}}
    <section class="relative overflow-hidden bg-linear-to-br from-slate-900 via-indigo-900 to-slate-900 text-white">
        {{-- แสงประดับพื้นหลัง --}}
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-24 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-6xl mx-auto px-4 py-20 md:py-28 text-center">
            <span class="inline-flex items-center gap-2 bg-white/10 border border-white/15 text-amber-300 text-xs font-medium px-4 py-1.5 rounded-full mb-6">
                ✦ บริการเช่ารถพรีเมียมในกรุงเทพมหานคร
            </span>

            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                ขับเคลื่อนทุกการเดินทาง<br>
                <span class="bg-linear-to-r from-amber-300 to-amber-500 bg-clip-text text-transparent">ในราคาที่คุ้มค่า</span>
            </h1>

            <p class="mt-6 text-lg text-slate-300 max-w-2xl mx-auto">
                เลือกจากรถหลากหลายประเภท ตั้งแต่มอเตอร์ไซค์ถึงรถหรู จองง่ายในไม่กี่คลิก พร้อมให้บริการคุณ
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <a href="#vehicles" class="bg-amber-400 hover:bg-amber-300 text-slate-900 font-semibold px-7 py-3 rounded-xl shadow-lg shadow-amber-500/20 transition">
                    เลือกชมรถทั้งหมด
                </a>
                @guest
                    <a href="{{ route('register') }}" class="bg-white/10 hover:bg-white/15 border border-white/20 text-white font-medium px-7 py-3 rounded-xl transition">
                        สมัครสมาชิกฟรี
                    </a>
                @endguest
            </div>

            <div class="mt-12 flex flex-wrap items-center justify-center gap-x-8 gap-y-3 text-sm text-slate-300">
                <span>✓ จองง่ายใน 1 นาที</span>
                <span>✓ ราคาโปร่งใส ไม่มีแอบแฝง</span>
                <span>✓ รถสะอาด พร้อมใช้งาน</span>
            </div>
        </div>
    </section>

    {{-- ===== รายการรถ ===== --}}
    <section id="vehicles" class="max-w-6xl mx-auto px-4 py-14">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-slate-900">รถพร้อมให้บริการ</h2>
            <p class="text-slate-500 mt-2">เลือกประเภทที่ต้องการ แล้วเริ่มการเดินทางของคุณ</p>
        </div>

        {{-- แถบฟิลเตอร์ --}}
        <form method="GET" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-3 mb-10 flex flex-col sm:flex-row sm:items-center gap-3 max-w-2xl mx-auto">
            <span class="flex items-center gap-2 px-2 text-slate-500 text-sm font-medium whitespace-nowrap">
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 0 1 1-1h12a1 1 0 0 1 .8 1.6L12 11.3V16a1 1 0 0 1-1.4.9l-2-1A1 1 0 0 1 8 15v-3.7L3.2 5.6A1 1 0 0 1 3 5z" clip-rule="evenodd" />
                </svg>
                ประเภทรถ
            </span>
            <select name="type" onchange="this.form.submit()"
                class="flex-1 rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                <option value="">ทุกประเภท</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @selected($selectedType === $type->id)>{{ $type->name }}</option>
                @endforeach
            </select>
            <span class="text-sm text-slate-400 px-2 whitespace-nowrap">{{ $vehicles->count() }} คัน</span>
        </form>

        {{-- การ์ดรถ --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($vehicles as $vehicle)
                <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    {{-- ส่วนบน: gradient + ไอคอนรถ --}}
                    <div class="relative h-44 bg-linear-to-br from-indigo-500 to-indigo-700 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-24 h-24 text-white/90 group-hover:scale-110 transition duration-300" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                            </svg>
                        </div>
                        {{-- ป้ายประเภท --}}
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">{{ $vehicle->vehicleType->name }}</span>
                        {{-- ป้ายสถานะ --}}
                        @if ($vehicle->status === 'available')
                            <span class="absolute top-3 right-3 bg-emerald-500 text-white text-xs font-medium px-2.5 py-1 rounded-full">● ว่าง</span>
                        @else
                            <span class="absolute top-3 right-3 bg-slate-700/90 text-white text-xs font-medium px-2.5 py-1 rounded-full">● ไม่ว่าง</span>
                        @endif
                    </div>

                    {{-- รายละเอียด --}}
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900">{{ $vehicle->brand }} {{ $vehicle->model }}</h3>
                        <div class="mt-4 flex items-end justify-between">
                            <div>
                                <span class="text-2xl font-extrabold text-slate-900">{{ number_format($vehicle->daily_rate) }}</span>
                                <span class="text-sm text-slate-400">฿ / วัน</span>
                            </div>
                            @if ($vehicle->status === 'available')
                                <a href="{{ route('rentals.create', $vehicle) }}"
                                    class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                                    เช่าเลย
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            @else
                                <button disabled class="bg-slate-100 text-slate-400 text-sm font-medium px-4 py-2.5 rounded-xl cursor-not-allowed">ไม่ว่าง</button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="text-6xl mb-4">🔍</div>
                    <p class="text-slate-500">ไม่พบรถในประเภทที่เลือก</p>
                    <a href="{{ route('vehicles.index') }}" class="inline-block mt-3 text-indigo-600 font-medium hover:underline">ดูรถทั้งหมด</a>
                </div>
            @endforelse
        </div>
    </section>
</x-layout>
