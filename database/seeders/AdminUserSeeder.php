<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // updateOrCreate -> รันซ้ำได้ไม่ซ้ำซ้อน (idempotent)
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'ผู้ดูแลระบบ',
                'email' => 'admin@carrental.local',
                'phone' => '0000000000',
                'address' => '-',
                'password' => 'admin1234', // hash อัตโนมัติด้วย cast — ควรเปลี่ยนใน production
                'role' => 'admin',
            ]
        );
    }
}
