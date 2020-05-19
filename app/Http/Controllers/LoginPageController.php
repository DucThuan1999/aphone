<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPageController extends Controller
{
    function index()
    {
        return view('Pages.Login');
    }

    function postLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required|min:6|max:32'
            ],
            [
                'email.required' => 'Vui lòng điền email hoặc số điện thoại !!!',
                'password.required' => 'Vui lòng điền mật khẩu !!!',
                'password.min' => 'Mật khẩu quá ngắn ( ít nhất 6 ký tự ) !!!',
                'password.max' => 'Mật khẩu quá dài ( nhiều nhất 32 ký tự )'
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => '2'])) {
            return redirect('/');
        } else {
            return redirect('/login')->with('loginAlert', 'Vui lòng kiểm tra email / sđt hoặc mật khẩu !!!');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
