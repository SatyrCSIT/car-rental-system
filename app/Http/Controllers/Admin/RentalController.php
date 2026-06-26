<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RentalController extends Controller
{
    /**
     * การจองทั้งหมด (ทุกลูกค้า)
     */
    public function index(): View
    {
        $rentals = Rental::with(['user', 'vehicle.vehicleType'])->latest()->get();

        return view('admin.rentals.index', ['rentals' => $rentals]);
    }

    /**
     * เปลี่ยนสถานะการจอง + คืนรถอัตโนมัติเมื่อจบ/ยกเลิก
     */
    public function updateStatus(Request $request, Rental $rental): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,active,completed,cancelled'],
        ]);

        DB::transaction(function () use ($rental, $validated) {
            $rental->update($validated);

            // จบ/ยกเลิก -> รถกลับมาว่างให้เช่าอีกครั้ง
            if (in_array($validated['status'], ['completed', 'cancelled'], true)) {
                $rental->vehicle->update(['status' => 'available']);
            }
        });

        return back()->with('status', 'อัปเดตสถานะการจองเรียบร้อยแล้ว');
    }
}
