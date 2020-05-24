<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompareController extends Controller
{
    function index()
    {
        return view('Pages.Compare');
    }
}
