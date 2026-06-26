<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            ['vehicle_type_id' => 2, 'brand' => 'Toyota', 'model' => 'Yaris', 'license_plate' => 'กก1111', 'daily_rate' => 900, 'status' => 'available'],
            ['vehicle_type_id' => 2, 'brand' => 'Honda', 'model' => 'City', 'license_plate' => 'กก2222', 'daily_rate' => 1000, 'status' => 'available'],
            ['vehicle_type_id' => 1, 'brand' => 'Honda', 'model' => 'Wave 110i', 'license_plate' => 'ขข3333', 'daily_rate' => 300, 'status' => 'available'],
            ['vehicle_type_id' => 3, 'brand' => 'Isuzu', 'model' => 'D-Max', 'license_plate' => 'คค4444', 'daily_rate' => 1500, 'status' => 'rented'],
            ['vehicle_type_id' => 8, 'brand' => 'Toyota', 'model' => 'Innova', 'license_plate' => 'งง5555', 'daily_rate' => 1800, 'status' => 'available'],
            ['vehicle_type_id' => 11, 'brand' => 'BYD', 'model' => 'Atto 3', 'license_plate' => 'จจ6666', 'daily_rate' => 2000, 'status' => 'available'],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
