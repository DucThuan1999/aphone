<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoUserController extends Controller
{
    function index()
    {

        if (Auth::check()) {
            if (Auth::user()->email_verified_at === null) {
                return view('Pages.VerifyAlert');
            } else {
                $user = Auth::user();
                $address = Address::where('user_id', $user->id)->where('default', 1)->first();
                $province = $address->province->first();
                $district = $address->district->first();
                $ward = $address->ward->first();

                $location = [
                    'address' => $address,
                    'province' => $province,
                    'district' => $district,
                    'ward' => $ward,
                    'street' => $address->street
                ];

                return view('Pages.InfoUser', ['user' => $user, 'location' => (object) $location]);
            }
        } else
            return redirect('/login');
    }
}
