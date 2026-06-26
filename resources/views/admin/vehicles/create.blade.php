<x-admin-layout title="เพิ่มรถ">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-indigo-600 mb-4">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            กลับไปจัดการรถ
        </a>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h1 class="text-xl font-bold text-slate-900 mb-6">เพิ่มรถใหม่</h1>

            {{-- enctype สำคัญมากสำหรับการอัปโหลดไฟล์ --}}
            <form method="POST" action="{{ route('admin.vehicles.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.vehicles._fields', ['vehicle' => null])

                <button type="submit"
                    class="mt-6 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">
                    เพิ่มรถ
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
