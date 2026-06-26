<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * รีวิวทั้งหมด
     */
    public function index(): View
    {
        $feedbacks = Feedback::with(['user', 'rental.vehicle'])->latest()->get();

        return view('admin.feedbacks.index', ['feedbacks' => $feedbacks]);
    }

    /**
     * ลบรีวิว
     */
    public function destroy(Feedback $feedback): RedirectResponse
    {
        $feedback->delete();

        return back()->with('status', 'ลบรีวิวเรียบร้อยแล้ว');
    }
}
