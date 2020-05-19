<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;

class VerifyPageController extends Controller
{
    function index()
    {
        if (request()->has('email') && request()->has('password')) {
            $users = Users::where('email', request()->get('email'))->where('password', request()->get('password'));
            $users->update(['email_verified_at' => now()]);

            return view('Pages.VerifyChecked');
        }
        return view('Pages.404');
    }
}
