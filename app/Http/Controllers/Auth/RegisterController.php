<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * แสดงฟอร์มสมัครสมาชิก
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * บันทึกสมาชิกใหม่
     */
    public function store(Request $request): RedirectResponse
    {
        // validate ทุก field (กฎ 4: กันข้อมูลไม่ถูกต้อง/อันตราย)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:50', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'digits:10'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // ไม่รับ 'role' จากฟอร์ม -> ใช้ค่า default 'customer' ของ DB เสมอ
        // (ปิดช่องโหว่ register_admin เดิมที่ใครก็สมัครเป็น admin ได้)
        $user = User::create($validated);

        // password ถูก hash อัตโนมัติด้วย cast 'hashed' ใน Model (ไม่ต้อง hash เอง)
        Auth::login($user);

        return redirect()->route('vehicles.index')
            ->with('status', 'สมัครสมาชิกสำเร็จ ยินดีต้อนรับ!');
    }
}
