<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * ฟอร์มเขียนรีวิวสำหรับการเช่าที่เสร็จสิ้นแล้ว
     */
    public function create(Rental $rental): View|RedirectResponse
    {
        $this->ensureReviewable($rental);

        if ($rental->feedbacks()->exists()) {
            return redirect()->route('rentals.index')->with('status', 'คุณรีวิวการเช่านี้ไปแล้ว');
        }

        return view('feedbacks.create', ['rental' => $rental]);
    }

    /**
     * บันทึกรีวิว
     */
    public function store(Request $request, Rental $rental): RedirectResponse
    {
        $this->ensureReviewable($rental);

        if ($rental->feedbacks()->exists()) {
            return redirect()->route('rentals.index')->with('status', 'คุณรีวิวการเช่านี้ไปแล้ว');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        // ผูก rental_id อัตโนมัติผ่าน relationship + ใส่ user_id ของเจ้าของ
        $rental->feedbacks()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'message' => $validated['message'],
        ]);

        return redirect()->route('rentals.index')->with('status', 'ขอบคุณสำหรับรีวิว!');
    }

    /**
     * รีวิวได้เฉพาะการเช่าของตัวเอง และต้อง "เสร็จสิ้น" แล้ว (กฎ 4)
     */
    private function ensureReviewable(Rental $rental): void
    {
        abort_unless($rental->user_id === auth()->id(), 403);
        abort_unless($rental->status === 'completed', 403, 'รีวิวได้หลังการเช่าเสร็จสิ้นแล้วเท่านั้น');
    }
}
