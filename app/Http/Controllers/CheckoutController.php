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
    function success()
    {
        $user = Auth::user();
        Cart::instance($user)->destroy();
        return view('Pages.CheckoutSuccess');
    }
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
        $address = new Address();
        $bill = new Bills();

        if ($request->another_address == 'on') {
            $address->user_id = $user->id;
            $address->province_id = $request->another_province;
            $address->district_id = $request->another_district;
            $address->ward_id = $request->another_ward;
            $address->street = $request->another_street;

            $address->save();
        }
        $bill->status = 1;
        $bill->total = (float) str_replace(',', '', Cart::priceTotal(0));
        $bill->user_id = $user->id;
        $bill->total_discount = (float) str_replace(',', '', Cart::discount(0));
        $bill->note = $request->note;
        $bill->payment = $request->method_payment;
        $bill->address_id = $address->id !== null ? $address->id : 0;
        $bill->save();


        $array_info_bill = [];
        foreach ($cart as $itemCart) {
            $info_bill = new Info_bills();
            $info_bill->bill_id = $bill->id;
            $info_bill->product_id = $itemCart->id;
            $info_bill->price = $itemCart->price;
            $info_bill->qty = $itemCart->qty;
            $info_bill->discount = $itemCart->discount;
            // $info_bill->save();
            array_push($array_info_bill, $info_bill);
        }

        if ($bill->total >= 7000000) {
            return view('Pages.Deposit');
        } else {
            return redirect('/checkout/success');
        }
        // return ['cart' => $cart, 'bill' => $bill, 'address' => $address, $array_info_bill];
    }
}
