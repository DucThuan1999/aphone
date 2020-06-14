<?php

namespace App\Http\Controllers;

use App\Bills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $bills = Bills::with('product')->where('user_id', $user->id)->get();
            return view('Pages.Order', ['bills' => $bills]);
        }
    }

    function single($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $bill = Bills::with('product')->where('id', $id)->get();
            return view('Pages.SingleOrder', ['bill' => $bill]);
        }
    }
}
