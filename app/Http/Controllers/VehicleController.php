<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * แสดงรายการรถ + กรองตามประเภท (ถ้ามี)
     */
    public function index(Request $request): View
    {
        // ดึงประเภทรถไว้ทำ dropdown
        $types = VehicleType::orderBy('name')->get();

        // integer() บังคับให้เป็นตัวเลขเสมอ ค่าแปลก ๆ จะกลายเป็น 0 -> null (กัน SQL injection ตั้งแต่ต้นทาง)
        $selectedType = $request->integer('type') ?: null;

        $vehicles = Vehicle::query()
            ->with('vehicleType')
            // when(): กรองเฉพาะตอนมี $selectedType — where() ใช้ binding ปลอดภัยจาก SQLi
            ->when($selectedType, fn ($query) => $query->where('vehicle_type_id', $selectedType))
            ->latest()
            ->get();

        return view('vehicles.index', [
            'vehicles' => $vehicles,
            'types' => $types,
            'selectedType' => $selectedType,
        ]);
    }
}
