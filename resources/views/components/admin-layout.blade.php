{{-- Layout สำหรับฝั่ง Admin (แยกจากหน้าลูกค้า) --}}
@props(['title' => 'Admin'])

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — Admin</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col antialiased">
    <header class="bg-slate-900 text-slate-300">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-bold text-white">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-indigo-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h12v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-8z" />
                    </svg>
                </span>
                Admin Panel
            </a>

            <nav class="flex items-center gap-1 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg hover:bg-slate-800 transition">แดชบอร์ด</a>
                <a href="{{ route('admin.vehicles.index') }}" class="px-3 py-2 rounded-lg hover:bg-slate-800 transition">จัดการรถ</a>
                <a href="{{ route('admin.rentals.index') }}" class="px-3 py-2 rounded-lg hover:bg-slate-800 transition">การจอง</a>
                <a href="{{ route('admin.feedbacks.index') }}" class="px-3 py-2 rounded-lg hover:bg-slate-800 transition">รีวิว</a>
                <a href="{{ route('vehicles.index') }}" class="px-3 py-2 rounded-lg hover:bg-slate-800 transition">กลับหน้าเว็บ</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-2 rounded-lg text-rose-300 hover:bg-slate-800 transition">ออกจากระบบ</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        @if (session('status'))
            <div class="max-w-6xl mx-auto px-4 pt-4">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">{{ session('status') }}</div>
            </div>
        @endif

        {{ $slot }}
    </main>
</body>

</html>
