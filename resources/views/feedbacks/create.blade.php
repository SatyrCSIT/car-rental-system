<x-layout title="เขียนรีวิว">
    <div class="max-w-lg mx-auto px-4 py-10">
        <a href="{{ route('rentals.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-indigo-600 mb-4">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            กลับไปการจองของฉัน
        </a>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h1 class="text-xl font-bold text-slate-900">เขียนรีวิว</h1>
            <p class="text-slate-500 text-sm mt-1">{{ $rental->vehicle->brand }} {{ $rental->vehicle->model }}</p>

            <form method="POST" action="{{ route('feedbacks.store', $rental) }}" class="mt-5 space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">ให้คะแนน</label>
                    <div class="flex gap-1 text-4xl" id="starRating">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" data-value="{{ $i }}" class="star leading-none text-slate-300 hover:scale-110 transition">★</button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', 5) }}">
                    @error('rating') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-slate-600 mb-1">ความคิดเห็น</label>
                    <textarea name="message" id="message" rows="4"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">{{ old('message') }}</textarea>
                    @error('message') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">
                    ส่งรีวิว
                </button>
            </form>
        </div>
    </div>

    {{-- ดาวให้คะแนนแบบคลิกได้ --}}
    <script>
        (function () {
            const input = document.getElementById('ratingInput');
            const stars = Array.from(document.querySelectorAll('#starRating .star'));

            function paint(value) {
                stars.forEach(s => {
                    s.classList.toggle('text-amber-400', Number(s.dataset.value) <= value);
                    s.classList.toggle('text-slate-300', Number(s.dataset.value) > value);
                });
            }

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    input.value = star.dataset.value;
                    paint(Number(star.dataset.value));
                });
            });

            paint(Number(input.value)); // ระบายดาวเริ่มต้น
        })();
    </script>
</x-layout>
