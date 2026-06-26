<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleTypeSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'มอเตอร์ไซค์',
            'รถเก๋ง',
            'รถกระบะ',
            'รถตู้',
            'รถพิเศษ',
            'รถอีโคคาร์',
            'รถ SUV',
            'รถ MPV อเนกประสงค์',
            'รถหรู',
            'รถสปอร์ต',
            'รถไฟฟ้า EV',
            'รถบัส รถโดยสาร',
        ];

        $now = now();
        $rows = array_map(fn($name) => [
            'name' => $name,
            'created_at' => $now,
            'updated_at' => $now,
        ], $names);

        DB::table('vehicle_types')->insert($rows);
    }
}