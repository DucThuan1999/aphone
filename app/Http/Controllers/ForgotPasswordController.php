<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    function index()
    {
        return view('Pages.ForgotPassword');
    }

    function postForgotPassword(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
            ],
            [
                'email.required' => 'Vui lòng điền email !!!',
            ]
        );

        $user = Users::where('email', request()->get('email'))->first();
        if ($user) {
            Mail::to($user)->send(new ForgotPassword($user));
            return redirect('/forgotpassword')->with('loginAlertSuccess', 'Email đổi mật khẩu đã được gửi vào email của bạn !!!');
        } else {
            return redirect('/forgotpassword')->with('loginAlert', 'Vui lòng kiểm tra lại email !!!');
        }
    }

    function changePassword()
    {
        return view('Pages.ChangePasswordForgot');
    }

    function postChangePassword(Request $request)
    {
        $this->validate(
            $request,
            [
                'password_old' => 'required|min:6|max:32',
                'password_new' => 'required|min:6|max:32',
                'password_new_confirm' => 'required|same:password_new',
            ],
            [
                'password_old.required' => 'Vui lòng điền mật khẩu cũ !!!',
                'password_old.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'password_old.max' => 'Mật khẩu tối đa 32 ký tự',
                'password_new.required' => 'Vui lòng điền mật khẩu mới !!!',
                'password_new.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'password_new.max' => 'Mật khẩu tối đa 32 ký tự',
                'password_new_confirm.required' => 'Vui lòng điền lại mật khẩu !!!',
                'password_new_confirm.same' => 'Mật khẩu nhập lại không khớp',
            ]
        );

        $password_old = $request->password_old;
        $password_new = $request->password_new;
        $password_new_confirm = $request->password_new_confirm;
        $email = $request->email;

        if ($email && $password_old && $password_new && $password_new_confirm) {
            $user = Users::where('email', $email)->first();
            if ($user && Hash::check($password_old, $user->password)) {
                $user->update(['password' => bcrypt($password_new)]);
                return redirect('/login')->with('loginAlertSuccess', 'Đổi mật khẩu thành công !!!');
            }
        }
        return back()->with('loginAlert', 'Vui lòng kiểm tra lại mật khẩu !!!');
    }
}
