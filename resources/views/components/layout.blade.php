{{-- Layout ส่วนกลาง ใช้ร่วมทุกหน้า (เรียกผ่าน <x-layout>) --}}
@props(['title' => 'CarRental — เช่ารถง่าย ๆ ในที่เดียว'])

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col antialiased">
    {{-- Header แบบ sticky + เบลอพื้นหลัง --}}
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('vehicles.index') }}" class="flex items-center gap-2 text-lg font-extrabold text-slate-900">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-linear-to-br from-indigo-500 to-indigo-700 text-white">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                    </svg>
                </span>
                Car<span class="text-indigo-600">Rental</span>
            </a>

            <nav class="flex items-center gap-1 sm:gap-2 text-sm">
                <a href="{{ route('vehicles.index') }}" class="px-3 py-2 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-slate-100 transition">รถทั้งหมด</a>

                @auth
                    <span class="hidden sm:inline text-slate-600 px-2">สวัสดี, <span class="font-semibold text-slate-900">{{ auth()->user()->name }}</span></span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-lg text-rose-500 hover:bg-rose-50 transition">ออกจากระบบ</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-slate-100 transition">เข้าสู่ระบบ</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition">สมัครสมาชิก</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-1">
        {{-- ข้อความแจ้งเตือน (flash message) --}}
        @if (session('status'))
            <div class="max-w-6xl mx-auto px-4 pt-4">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm3.7-9.3a1 1 0 0 0-1.4-1.4L9 10.6 7.7 9.3a1 1 0 0 0-1.4 1.4l2 2a1 1 0 0 0 1.4 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ session('status') }}
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-400 mt-16">
        <div class="max-w-6xl mx-auto px-4 py-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <div class="flex items-center gap-2 text-white font-extrabold text-lg">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-600">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                        </svg>
                    </span>
                    Car<span class="text-indigo-400">Rental</span>
                </div>
                <p class="mt-3 text-sm max-w-sm">บริการเช่ารถออนไลน์ จองง่าย ปลอดภัย ในราคาที่คุ้มค่า พร้อมให้บริการคุณทุกการเดินทาง</p>
            </div>
            <div class="text-sm text-slate-500">© {{ date('Y') }} Car Rental System. สงวนลิขสิทธิ์.</div>
        </div>
    </footer>
</body>

</html>
