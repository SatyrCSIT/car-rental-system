<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RentalController extends Controller
{
    /**
     * รายการจองของผู้ใช้ที่ล็อกอินอยู่
     */
    public function index(): View
    {
        $rentals = auth()->user()
            ->rentals()
            ->with('vehicle.vehicleType')
            ->latest()
            ->get();

        return view('rentals.index', ['rentals' => $rentals]);
    }

    /**
     * แสดงฟอร์มจองรถคันที่เลือก
     */
    public function create(Vehicle $vehicle): View|RedirectResponse
    {
        if ($vehicle->status !== 'available') {
            return redirect()
                ->route('vehicles.index')
                ->with('status', 'ขออภัย รถคันนี้ไม่ว่างให้เช่าแล้ว');
        }

        return view('rentals.create', ['vehicle' => $vehicle]);
    }

    /**
     * บันทึกการจอง
     */
    public function store(Request $request, Vehicle $vehicle): RedirectResponse
    {
        // กันจองรถที่ไม่ว่าง (เผื่อมีคนจองตัดหน้า)
        if ($vehicle->status !== 'available') {
            return redirect()
                ->route('vehicles.index')
                ->with('status', 'ขออภัย รถคันนี้ไม่ว่างให้เช่าแล้ว');
        }

        // validate วันที่ (กฎ 4): เริ่มต้องไม่ใช่อดีต, คืนต้องหลังวันเริ่ม
        $validated = $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);

        // คำนวณราคาที่ฝั่ง server เสมอ (ไม่เชื่อค่าจาก client)
        $days = (int) $start->diffInDays($end);
        $totalPrice = $days * $vehicle->daily_rate;

        // transaction: สร้าง rental + อัปเดตสถานะรถ ต้องสำเร็จพร้อมกัน (กฎ 4: ความถูกต้องข้อมูล)
        DB::transaction(function () use ($vehicle, $start, $end, $totalPrice) {
            $vehicle->rentals()->create([
                'user_id' => auth()->id(),
                'start_date' => $start,
                'end_date' => $end,
                'total_price' => $totalPrice,
                'status' => 'confirmed',
            ]);

            $vehicle->update(['status' => 'rented']);
        });

        return redirect()
            ->route('rentals.index')
            ->with('status', 'จองรถสำเร็จ! ขอบคุณที่ใช้บริการ');
    }
}
