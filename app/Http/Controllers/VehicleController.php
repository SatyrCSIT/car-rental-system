<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * แสดงรายการรถ + กรองตามประเภท + รีวิวล่าสุด
     */
    public function index(Request $request): View
    {
        $types = VehicleType::orderBy('name')->get();

        // integer() บังคับให้เป็นตัวเลขเสมอ ค่าแปลก ๆ จะกลายเป็น 0 -> null (กัน SQL injection)
        $selectedType = $request->integer('type') ?: null;

        $vehicles = Vehicle::query()
            ->with('vehicleType')
            ->when($selectedType, fn ($query) => $query->where('vehicle_type_id', $selectedType))
            ->latest()
            ->get();

        // รีวิวล่าสุดไว้โชว์หน้าแรก สร้างความน่าเชื่อถือ
        $feedbacks = Feedback::with('user')->latest()->take(6)->get();

        return view('vehicles.index', [
            'vehicles' => $vehicles,
            'types' => $types,
            'selectedType' => $selectedType,
            'feedbacks' => $feedbacks,
        ]);
    }
}
