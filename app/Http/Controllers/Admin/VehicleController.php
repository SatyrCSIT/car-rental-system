<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * รายการรถทั้งหมด
     */
    public function index(): View
    {
        $vehicles = Vehicle::with('vehicleType')->latest()->get();

        return view('admin.vehicles.index', ['vehicles' => $vehicles]);
    }

    /**
     * ฟอร์มเพิ่มรถ
     */
    public function create(): View
    {
        return view('admin.vehicles.create', ['types' => VehicleType::orderBy('name')->get()]);
    }

    /**
     * บันทึกรถใหม่
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateVehicle($request, imageRequired: true);

        // เก็บไฟล์ด้วยชื่อสุ่มของ Laravel ใน storage/app/public/vehicles (กัน RCE)
        $validated['image_path'] = $request->file('image')->store('vehicles', 'public');
        unset($validated['image']);

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')->with('status', 'เพิ่มรถเรียบร้อยแล้ว');
    }

    /**
     * ฟอร์มแก้ไขรถ
     */
    public function edit(Vehicle $vehicle): View
    {
        return view('admin.vehicles.edit', [
            'vehicle' => $vehicle,
            'types' => VehicleType::orderBy('name')->get(),
        ]);
    }

    /**
     * บันทึกการแก้ไข
     */
    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $validated = $this->validateVehicle($request, imageRequired: false, ignoreVehicle: $vehicle);

        // อัปโหลดรูปใหม่เฉพาะเมื่อมีการเลือกไฟล์ (ไม่งั้นใช้รูปเดิม)
        if ($request->hasFile('image')) {
            if ($vehicle->image_path) {
                Storage::disk('public')->delete($vehicle->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('vehicles', 'public');
        }
        unset($validated['image']);

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')->with('status', 'บันทึกการแก้ไขเรียบร้อยแล้ว');
    }

    /**
     * เปลี่ยนสถานะรถ
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
        // กันลบรถที่มีประวัติการเช่า (FK RESTRICT กันที่ DB เช็คก่อนเพื่อข้อความที่ชัดเจน)
        if ($vehicle->rentals()->exists()) {
            return back()->with('status', 'ลบไม่ได้ — รถคันนี้มีประวัติการเช่าอยู่');
        }

        if ($vehicle->image_path) {
            Storage::disk('public')->delete($vehicle->image_path);
        }

        $vehicle->delete();

        return back()->with('status', 'ลบรถเรียบร้อยแล้ว');
    }

    /**
     * กฎ validate ที่ใช้ร่วมกันระหว่างเพิ่ม/แก้ไข (กฎ 1: ไม่ซ้ำซ้อน)
     */
    private function validateVehicle(Request $request, bool $imageRequired, ?Vehicle $ignoreVehicle = null): array
    {
        return $request->validate([
            'vehicle_type_id' => ['required', 'exists:vehicle_types,id'],
            'brand' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],
            'license_plate' => ['required', 'string', 'max:20', Rule::unique('vehicles', 'license_plate')->ignore($ignoreVehicle)],
            'daily_rate' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:available,rented,maintenance'],
            // image: ตรวจว่าเป็นรูปจริง + จำกัดชนิด + ขนาด <= 2MB (กัน RCE/ไฟล์อันตราย)
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}
