<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index() {
        return view('login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Email không được để trống.',
            'username.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);

        if(Auth::attempt([
            'name'=>$request->input('username'),
            'password'=>$request->input('password')
        ])) {
            $user = Auth::user();
            Session()->flash('message','Đăng nhập thành công');
            return redirect()->route('admin.main');
        } else {
            Session()->flash('message','Tên đăng nhập hoặc mật khẩu không chính xác');
            return redirect()->back();
        }
    }
}
