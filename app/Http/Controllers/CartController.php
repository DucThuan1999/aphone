<?php

namespace App\Http\Controllers;

use App\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function index()
    {
        return view('Pages.Cart');
    }

    function addItem(Request $request)
    {
        $product = Products::find($request->id);
        $cart = Cart::add($product, ['card_qty' => 1, 'color' => $request->color]);
        return $cart;
    }
}
