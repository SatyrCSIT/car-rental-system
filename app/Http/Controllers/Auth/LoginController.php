<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * แสดงฟอร์มเข้าสู่ระบบ
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * ตรวจสอบและเข้าสู่ระบบ
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Auth::attempt หา user + เทียบรหัสผ่านแบบ hash ให้เอง (ปลอดภัย)
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['username' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'])
                ->onlyInput('username');
        }

        // สร้าง session id ใหม่ กัน session fixation (กฎ 4)
        $request->session()->regenerate();

        return redirect()->intended(route('vehicles.index'));
    }

    /**
     * ออกจากระบบ
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        // ล้าง session เดิมทิ้งทั้งหมด
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vehicles.index');
    }
}
