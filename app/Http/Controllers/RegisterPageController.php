<?php

namespace App\Http\Controllers;

use App\Address;
use App\Mail\VerifyMail;
use App\Province;
use App\Users;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\App;
// use App\Notifications\StatusUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterPageController extends Controller
{
    function index()
    {
        $provinces = Province::all();
        return view('Pages.Register', ['provinces' => $provinces]);
    }

    function postRegister(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required|min:1',
            'last_name' => 'required|min:1',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'street' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:32',
            'confirm_password' => 'required|same:password'
        ], [
            'first_name.required' => 'Vui lòng nhập họ người dùng',
            'last_name.required' => 'Vui lòng nhập tên người dùng',
            'province.required' => 'Vui lòng nhập Tỉnh / Thành phố',
            'district.required' => 'Vui lòng nhập Quận',
            'ward.required' => 'Vui lòng nhập Phường xã',
            'street.required' => 'Vui lòng nhập địa chỉ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 32 ký tự',
            'confirm_password.required' => 'Vui lòng điền xác nhận mật khẩu',
            'confirm_password.same' => 'Mật khẩu nhập lại không khớp',
        ]);

        $user = new Users();
        $user->firstname = $request->first_name;
        $user->lastname = $request->last_name;
        $user->phone = $request->phone != null ? $request->phone : "";
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = 1;
        $user->role = 2;
        $user->save();

        $address = new Address();
        $address->user_id = $user->id;
        $address->province_id = $request->province;
        $address->district_id = $request->district;
        $address->ward_id = $request->ward;
        $address->street = $request->street;
        $address->save();

        // Auth::attempt(['email' => $user->email, 'password' => $user->password]);

        // return (new StatusUpdate($user))->toMail($user);
        Mail::to($user)->send(new VerifyMail($user));
        return redirect('/login')->with('loginAlertSuccess',  'Đăng ký thành công !!! Email xác nhận đã được gửi đến email của bạn, vui lòng xác nhận để hoàn tất việc đăng ký !!!');
    }
}
