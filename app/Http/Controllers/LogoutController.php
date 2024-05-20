<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function logout(Request $request) {
        // Đăng xuất người dùng hiện tại
        Auth::logout();

        // Xóa phiên hiện tại của người dùng
        $request->session()->invalidate();

        // Tạo một phiên mới
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Đăng Xuất Tài Khoản Thành Công');
    }
}
