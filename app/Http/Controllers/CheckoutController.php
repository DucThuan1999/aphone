<?php

namespace App\Http\Controllers;

use App\Address;
use App\Bills;
use App\Info_bills;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function index()
    {
        if (Auth::check()) {
            if (Auth::user()->email_verified_at === null) {
                return view('Pages.VerifyAlert');
            } else {
                $user = Auth::user();
                $addresses = Address::where('user_id', $user->id)->get();

                return view('Pages.Checkout', ['user' => $user, 'addresses' => $addresses]);
            }
        } else
            return redirect('/login');
    }

    function addBills(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::instance($user)->content();
        $bill = new Bills();

        $bill->status = 1;
        $bill->total = Cart::priceTotal(0);
        $bill->user_id = $user->id;
        $bill->total_discount = Cart::discount(0);

        $array_info_bill = [];
        foreach ($cart as $itemCart) {
            $info_bill = new Info_bills();
            $info_bill->bill_id = $bill->id;
            $info_bill->product_id = $itemCart->id;
            $info_bill->price = $itemCart->price;
            $info_bill->qty = $itemCart->qty;
            $info_bill->discount = $itemCart->discount;
            array_push($array_info_bill, $info_bill);
        }

        return [$cart, $bill, $array_info_bill];
    }
}
