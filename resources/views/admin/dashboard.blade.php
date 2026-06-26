<x-admin-layout title="แดชบอร์ด">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-1">แดชบอร์ด</h1>
        <p class="text-slate-500 mb-6">ภาพรวมระบบเช่ารถ</p>

        {{-- การ์ดสถิติ --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-3">
                <span class="w-11 h-11 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                    </svg>
                </span>
                <div>
                    <div class="text-2xl font-extrabold text-slate-900">{{ $stats['vehicles'] }}</div>
                    <div class="text-xs text-slate-500">รถทั้งหมด</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-3">
                <span class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm3.7-9.3a1 1 0 0 0-1.4-1.4L9 10.6 7.7 9.3a1 1 0 0 0-1.4 1.4l2 2a1 1 0 0 0 1.4 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div>
                    <div class="text-2xl font-extrabold text-slate-900">{{ $stats['available'] }}</div>
                    <div class="text-xs text-slate-500">รถว่าง</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-3">
                <span class="w-11 h-11 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5.5 2a.5.5 0 0 1 .5.5V3h8v-.5a.5.5 0 0 1 1 0V3h.5A1.5 1.5 0 0 1 17 4.5v10A1.5 1.5 0 0 1 15.5 16h-11A1.5 1.5 0 0 1 3 14.5v-10A1.5 1.5 0 0 1 4.5 3H5v-.5a.5.5 0 0 1 .5-.5zM4.5 6.5v8h11v-8h-11z" />
                    </svg>
                </span>
                <div>
                    <div class="text-2xl font-extrabold text-slate-900">{{ $stats['rentals'] }}</div>
                    <div class="text-xs text-slate-500">การจองทั้งหมด</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-3">
                <span class="w-11 h-11 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-7 8a7 7 0 0 1 14 0H3z" />
                    </svg>
                </span>
                <div>
                    <div class="text-2xl font-extrabold text-slate-900">{{ $stats['customers'] }}</div>
                    <div class="text-xs text-slate-500">ลูกค้า</div>
                </div>
            </div>
        </div>

        {{-- เมนูจัดการ --}}
        <h2 class="text-lg font-bold text-slate-900 mb-3">เมนูจัดการ</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('admin.vehicles.index') }}"
                class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md hover:border-indigo-200 transition flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                    </svg>
                </span>
                <div>
                    <div class="font-bold text-slate-900">จัดการรถ</div>
                    <div class="text-sm text-slate-500">ดู เปลี่ยนสถานะ และลบรถ</div>
                </div>
            </a>

            <a href="{{ route('admin.rentals.index') }}"
                class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md hover:border-indigo-200 transition flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5.5 2a.5.5 0 0 1 .5.5V3h8v-.5a.5.5 0 0 1 1 0V3h.5A1.5 1.5 0 0 1 17 4.5v10A1.5 1.5 0 0 1 15.5 16h-11A1.5 1.5 0 0 1 3 14.5v-10A1.5 1.5 0 0 1 4.5 3H5v-.5a.5.5 0 0 1 .5-.5zM4.5 6.5v8h11v-8h-11z" />
                    </svg>
                </span>
                <div>
                    <div class="font-bold text-slate-900">ดูการจอง</div>
                    <div class="text-sm text-slate-500">ดูและจัดการสถานะการเช่า</div>
                </div>
            </a>

            <a href="{{ route('admin.feedbacks.index') }}"
                class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md hover:border-indigo-200 transition flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-rose-500 text-white flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.05 3.69c.3-.92 1.6-.92 1.9 0l1.07 3.29h3.46c.97 0 1.37 1.24.59 1.81l-2.8 2.03 1.07 3.29c.3.92-.75 1.69-1.54 1.12L10 14.99l-2.8 2.03c-.79.57-1.84-.2-1.54-1.12l1.07-3.29-2.8-2.03c-.78-.57-.38-1.81.59-1.81h3.46l1.07-3.29z" />
                    </svg>
                </span>
                <div>
                    <div class="font-bold text-slate-900">รีวิว</div>
                    <div class="text-sm text-slate-500">ดูและลบรีวิวจากลูกค้า</div>
                </div>
            </a>
        </div>
    </div>
</x-admin-layout>
