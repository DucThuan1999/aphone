<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishListController extends Controller
{
    function index()
    {
        return view('Pages.WishList');
    }
}
