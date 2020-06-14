<?php

namespace App\Http\Controllers;

use App\Address;
use App\Bills;
use App\Colors_products;
use App\Coupon;
use App\Info_bills;
use App\Mail\Deposit;
use App\Mail\ConfirmOrder;
use App\Products;
use App\Users;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    function success()
    {
        $user = Auth::user();
        $this->updateQty();
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

        foreach ($cart as $itemCart) {
            $product = Products::find($itemCart->id);
            if (isset($product->promotions->first()->pivot->type_discount)) {
                if ($product->promotions->first()->pivot->type_discount === "percent") {
                    $percent = $product->promotions->first()->pivot->percent;
                    Cart::instance($user)->setDiscount($itemCart->rowId, $percent);
                    $bill->total = (float) str_replace(',', '', Cart::priceTotal(0));
                    $bill->total_discount += (float) str_replace(',', '', Cart::discount(0));
                }
                if ($product->promotions->first()->pivot->type_discount === "price") {
                    $price_discount = $product->promotions->first()->pivot->price_discount;
                    Cart::update($itemCart->rowId, ['price' => $itemCart->price - $price_discount]);
                    $bill->total = (float) str_replace(',', '', Cart::priceTotal(0)) - $price_discount;
                    $bill->total_discount += $price_discount;
                }
            } else {
                $bill->total = (float) str_replace(',', '', Cart::priceTotal(0));
                Cart::instance($user)->setGlobalDiscount($request->percent);
                $bill->total_discount = (float) str_replace(',', '', Cart::discount(0));
            }
        }
        $bill->status = 0; // đang xử lý
        $bill->user_id = $user->id;
        $bill->note = $request->note;
        $bill->payment = $request->method_payment;
        $bill->address_id = $request->address != null ? $request->address : $address->id;
        $bill->save();

        $array_info_bill = [];
        foreach ($cart as $itemCart) {
            $info_bill = new Info_bills();
            $info_bill->bill_id = $bill->id;
            $info_bill->product_id = $itemCart->id;
            $info_bill->qty = $itemCart->qty;
            $info_bill->color_id = $itemCart->options->colorSelected;
            $product = Products::find($itemCart->id);
            if (isset($product->promotions->first()->pivot->type_discount)) {
                if ($product->promotions->first()->pivot->type_discount === "percent") {
                    $info_bill->price = $itemCart->price * (1 -  $product->promotions->first()->pivot->percent / 100);
                    $info_bill->discount += $itemCart->price *  $product->promotions->first()->pivot->percent / 100;
                } else {
                    $info_bill->price = $itemCart->price -  $product->promotions->first()->pivot->price_discount;
                    $info_bill->discount += $product->promotions->first()->pivot->price_discount;
                }
            } else {
                $info_bill->price = $itemCart->price;
                $info_bill->discount = $itemCart->discount;
            }
            $info_bill->save();
            array_push($array_info_bill, $info_bill);
        }

        // if ($bill->total >= 7000000) {
        //     Mail::to($user)->send(new Deposit($user));
        //     return view('Pages.Deposit');
        // } else {
        Mail::to($user)->send(new ConfirmOrder($user, Cart::instance($user)->content()));
        return redirect('/checkout/success');
        // }
        // return ['cart' => $cart, 'bill' => $bill, 'address' => $address, $array_info_bill, 'percent' => $request->percent];
    }

    function updateQty()
    {
        $user = Auth::user();
        $cart = Cart::instance($user)->content();
        foreach ($cart as $itemCart) {
            $product_id = $itemCart->id;
            $old_product_qty = Products::find($product_id)->qty;
            $color_id = $itemCart->options->colorSelected;
            $old_color_qty = Colors_products::where('product_id', $product_id)->where('color_id', $color_id)->first()->quantity;

            Colors_products::where('product_id', $product_id)
                ->where('color_id', $color_id)->update(['quantity' => $old_color_qty - 1]);

            Products::find($product_id)->update(['qty' => $old_product_qty - 1]);
        }
    }

    function checkCoupon(Request $request)
    {
        $user = Auth::user();
        $coupon_code = $request->coupon;
        $coupon = Coupon::where('code', $coupon_code)->first();
        if ($coupon && $coupon->status !== 2 && Auth::check()) {
            $total_old = (float) str_replace(',', '', Cart::instance($user)->total(0));
            $discount_price = $total_old * $coupon->percent / 100;
            $total_new = $total_old - $discount_price;

            return ['status' => true, 'percent' => $coupon->percent, 'total' => number_format($total_new), 'discount_price' => number_format($discount_price)];
        } else {
            return ["status" => false];
        }
    }
}
