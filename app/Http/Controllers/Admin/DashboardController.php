<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * แดชบอร์ดสรุปภาพรวมระบบ
     */
    public function index(): View
    {
        $stats = [
            'vehicles' => Vehicle::count(),
            'available' => Vehicle::where('status', 'available')->count(),
            'rentals' => Rental::count(),
            'customers' => User::where('role', 'customer')->count(),
        ];

        return view('admin.dashboard', ['stats' => $stats]);
    }
}
