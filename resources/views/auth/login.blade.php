<x-layout title="เข้าสู่ระบบ — CarRental">
    <div class="max-w-md mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100 p-8">
            {{-- ไอคอนแบรนด์ --}}
            <div class="flex justify-center mb-4">
                <span class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-linear-to-br from-indigo-500 to-indigo-700 text-white">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                    </svg>
                </span>
            </div>
            <h1 class="text-2xl font-bold text-center text-slate-900">ยินดีต้อนรับกลับ</h1>
            <p class="text-center text-sm text-slate-500 mt-1 mb-6">เข้าสู่ระบบเพื่อเริ่มเช่ารถ</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf {{-- กัน CSRF (กฎ 4) --}}

                <div>
                    <label for="username" class="block text-sm font-medium text-slate-600 mb-1">ชื่อผู้ใช้</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    @error('username') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-600 mb-1">รหัสผ่าน</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-200">
                    จดจำฉันไว้
                </label>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">
                    เข้าสู่ระบบ
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-6">
                ยังไม่มีบัญชี?
                <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">สมัครสมาชิก</a>
            </p>
        </div>
    </div>
</x-layout>
