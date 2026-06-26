{{-- Layout ส่วนกลาง ใช้ร่วมทุกหน้า (เรียกผ่าน <x-layout>) --}}
@props(['title' => 'ระบบเช่ารถ'])

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- กัน CSRF token หลุด: ใช้สำหรับ JS/AJAX ในอนาคต --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- {{ }} auto-escape กัน XSS แม้แต่ใน title --}}
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            {{-- route() helper: ไม่ hardcode URL (กฎ 2) ลิงก์ไม่พังเวลาเปลี่ยน path --}}
            <a href="{{ route('vehicles.index') }}" class="text-xl font-bold text-blue-600">🚗 CarRental</a>
            <nav class="flex gap-4 text-sm">
                <a href="{{ route('vehicles.index') }}" class="text-gray-600 hover:text-blue-600">รถทั้งหมด</a>
            </nav>
        </div>
    </header>

    {{-- เนื้อหาแต่ละหน้าจะถูกใส่ตรง $slot นี้ --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t mt-8">
        <div class="max-w-6xl mx-auto px-4 py-4 text-center text-sm text-gray-400">
            © {{ date('Y') }} Car Rental System
        </div>
    </footer>
</body>

</html>
