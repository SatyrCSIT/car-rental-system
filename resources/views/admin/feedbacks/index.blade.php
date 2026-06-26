<x-admin-layout title="รีวิวจากลูกค้า">
    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">รีวิวจากลูกค้า</h1>
            <p class="text-slate-500 text-sm">ดูและลบรีวิวที่ไม่เหมาะสม</p>
        </div>

        @forelse ($feedbacks as $feedback)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-4">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-slate-800">{{ $feedback->user->name }}</span>
                            <span class="text-amber-400 text-sm">
                                @for ($i = 1; $i <= 5; $i++){{ $i <= $feedback->rating ? '★' : '☆' }}@endfor
                            </span>
                        </div>
                        @if ($feedback->rental)
                            <p class="text-xs text-slate-400 mt-0.5">
                                {{ $feedback->rental->vehicle->brand }} {{ $feedback->rental->vehicle->model }}
                            </p>
                        @endif
                        <p class="text-slate-600 text-sm mt-2">{{ $feedback->message }}</p>
                    </div>

                    <form method="POST" action="{{ route('admin.feedbacks.destroy', $feedback) }}"
                        onsubmit="return confirm('ยืนยันการลบรีวิวนี้?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-rose-500 hover:text-rose-700 text-sm font-medium">ลบ</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm text-center py-16 text-slate-400">
                ยังไม่มีรีวิว
            </div>
        @endforelse
    </div>
</x-admin-layout>
