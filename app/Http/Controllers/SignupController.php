<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use mysql_xdevapi\Exception;

class SignupController extends Controller
{
    //
    public function index() {
        return view('signup');
    }

    //
    public function store(Request $request) {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $re_password = $request->input('re-password');

        //
        if (User::usernameExists($username)) {
            return redirect()->back()->with('message', 'Tên Đăng Nhập Đã Tồn Tại');
        }

        //
        if ($password !== $re_password) {
            return redirect()->back()->with('message', 'Mật Khẩu Phải Giống Nhau');
        }

        //
        try {
            User::create([
                'name' => $username,
                'email' => $email,
                'password' => bcrypt($password),
                'role_id' => 1,
            ]);
            return redirect()->route('admin.main')->with('message', 'Đăng Ký Tài Khoản Thành Công');
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
