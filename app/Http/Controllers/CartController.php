<?php

namespace App\Http\Controllers;

use App\Colors;
use App\Info_products;
use App\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function __construct()
    {
        Cart::setGlobalTax(0);
    }
    function index()
    {
        return view('Pages.Cart');
    }

    function addItemCart(Request $request)
    {
        $product_id = $request->id;
        $product = Products::find($product_id);
        $colors = Colors::with('products')->whereHas('products', function ($query) use ($product_id) {
            $query->where('products.id', $product_id);
        })->get();

        if (Auth::check()) {
            $user = Auth::user();
            Cart::instance($user)->add($product, (int) $request->qty, ['colors' => $colors, 'colorSelected' => $request->color, 'img' => $product->image]);
        } else {
            Cart::add($product, (int) $request->qty, ['colors' => $colors, 'colorSelected' => $request->color, 'img' => $product->image]);
        }
        return Cart::content();
    }

    function updateItemCart(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cartItem = Cart::instance($user)->update($request->rowId, [
                'colorSelected' => $request->color,
                'qty' => (int) $request->qty
            ]);
        } else {
            $cartItem = Cart::update($request->rowId, [
                'colorSelected' => $request->color,
                'qty' => (int) $request->qty
            ]);
        }
        if ($request->inCartPage == true)
            return [$cartItem, 'totalPrice' => $this->getTotalPriceCart(), 'subtotal' => $cartItem->subtotal(0)];
    }

    function removeItemCart(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            Cart::instance($user)->remove($request->rowId);
        } else {
            Cart::remove($request->rowId);
        }

        if ($request->inCartPage == true)
            return $this->getTotalPriceCart();
    }

    function destroyCart(Request $request)
    {
        Cart::destroy();
    }


    function getTotalPriceCart()
    {
        $text = '<div id="showTotalPrice" class="cart-page-total">
                        <h2>Tổng cộng giỏ hàng</h2>
                        <ul>
                            <li>Tổng tiền <span>' . Cart::priceTotal(0) . ' đ</span></li>
                             <li>Thành tiền <span>' . Cart::total(0) . ' đ</span></li>
                        </ul>
                        <a href="/checkout">Tiến hành thanh toán</a>
                    </div>';
        return $text;
    }
}
