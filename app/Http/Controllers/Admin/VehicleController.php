<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * รายการรถทั้งหมด (สำหรับแอดมินจัดการ)
     */
    public function index(): View
    {
        $vehicles = Vehicle::with('vehicleType')->latest()->get();

        return view('admin.vehicles.index', ['vehicles' => $vehicles]);
    }

    /**
     * เปลี่ยนสถานะรถ (ว่าง / ไม่ว่าง / ซ่อมบำรุง)
     */
    public function updateStatus(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:available,rented,maintenance'],
        ]);

        $vehicle->update($validated);

        return back()->with('status', 'อัปเดตสถานะรถเรียบร้อยแล้ว');
    }

    /**
     * ลบรถ
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        // กันลบรถที่มีประวัติการเช่า (FK RESTRICT กันที่ DB อยู่แล้ว เช็คก่อนเพื่อข้อความที่ชัดเจน)
        if ($vehicle->rentals()->exists()) {
            return back()->with('status', 'ลบไม่ได้ — รถคันนี้มีประวัติการเช่าอยู่');
        }

        $vehicle->delete();

        return back()->with('status', 'ลบรถเรียบร้อยแล้ว');
    }
}
