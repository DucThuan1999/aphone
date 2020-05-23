<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    function postChangePassword(Request $request)
    {
        $checkboxChangePassword = $request->checkbox_changepassword;
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $phone = $request->phone;
        $address = $request->address;
        $password_old = $request->password_old;
        $password_new = $request->password_new;
        $password_new_confirm = $request->password_new_confirm;
        $email = $request->email;

        $this->validate(
            $request,
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ],
            [
                'firstname.required' => 'Vui lòng điền họ !!!',
                'lastname.required' => 'Vui lòng điền tên !!!',
                'email.required' => 'Vui lòng không sửa email !!!',
                'phone.required' => 'Vui lòng không sửa số điện thoại',
                'address.required' => 'Vui lòng điền địa chỉ !!!',
            ]
        );
        if ($checkboxChangePassword == 'on') {
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
        }
        if ($email && $address && $phone && $firstname && $lastname) {
            $user = Users::where('email', $email)->first();
            if ($user) {
                $user->update(['firstname' => $firstname, 'lastname' => $lastname, 'address' => $address]);
                if ($password_old && $password_new && $password_new_confirm) {
                    if (Hash::check($password_old, $user->password)) {
                        $user->update(['password' => bcrypt($password_new)]);
                    }
                }
                return redirect('/infouser')->with('changeAlertSuccess', 'Cập nhật thành công !!!');
            }
        }
        return redirect('/infouser')->with('changeAlert', 'Cập nhật không thành công !!!');
    }
}
