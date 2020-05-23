<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoUserController extends Controller
{
    function index()
    {
        if (Auth::check()) {
            if (Auth::user()->email_verified_at === null) {
                return view('Pages.VerifyAlert');
            } else
                return view('Pages.InfoUser', ['user' => Auth::user()]);
        } else
            return redirect('/login');
    }
}
