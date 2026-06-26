<x-layout title="สมัครสมาชิก — CarRental">
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
            <h1 class="text-2xl font-bold text-center text-slate-900">สร้างบัญชีใหม่</h1>
            <p class="text-center text-sm text-slate-500 mt-1 mb-6">สมัครฟรี เริ่มเช่ารถได้ทันที</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf {{-- กัน CSRF (กฎ 4) --}}

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-600 mb-1">ชื่อ - นามสกุล</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-slate-600 mb-1">ชื่อผู้ใช้ (สำหรับล็อกอิน)</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    @error('username') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600 mb-1">อีเมล</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    @error('email') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-600 mb-1">เบอร์โทรศัพท์ (10 หลัก)</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required inputmode="numeric"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    @error('phone') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-slate-600 mb-1">ที่อยู่</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    @error('address') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-600 mb-1">รหัสผ่าน (อย่างน้อย 8 ตัว)</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-600 mb-1">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">
                    สมัครสมาชิก
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-6">
                มีบัญชีอยู่แล้ว?
                <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">เข้าสู่ระบบ</a>
            </p>
        </div>
    </div>
</x-layout>
