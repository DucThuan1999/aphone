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
        $discount = $request->discount == null ? 0 : $request->discount;
        $product = Products::find($product_id);
        $colors = Colors::with('products')->whereHas('products', function ($query) use ($product_id) {
            $query->where('products.id', $product_id);
        })->get();

        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::instance($user)->add($product, (int) $request->qty, [
                'colors' => $colors,
                'colorSelected' => $request->color,
                'img' => $product->image
            ]);
            $rowId = $cart->rowId;
            Cart::instance($user)->setDiscount($rowId, $discount);
            // return $this->getLiMiniCart(Cart::instance($user)->content());
            return [
                'miniCart' => $this->getLiMiniCart(Cart::instance($user)->content()),
                'count' => Cart::instance($user)->count(),
                'totalMiniCart' => Cart::instance($user)->total(0)
            ];
        } else {
            $cart = Cart::add($product, (int) $request->qty, ['colors' => $colors, 'colorSelected' => $request->color, 'img' => $product->image])->discount((int) $discount);
            return [
                'miniCart' => $this->getLiMiniCart(Cart::content()),
                'count' => Cart::count(),
                'totalMiniCart' => Cart::total(0)
            ];
        }
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
            return [$this->getTotalPriceCart(), Cart::total(0)];
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
                        <button type="button" onclick="validateCheckout()" class="btn btn-primary mt-20">Tiến
                        hành thanh
                        toán</button>
                    </div>';
        return $text;
    }

    function getLiMiniCart($cart)
    {
        $text = '';
        foreach ($cart as $itemCart) {
            $text .= '<li class="products_row_' . $itemCart->rowId . '">
            <a href="products/' . $itemCart->id . '" class="minicart-product-image">
                <img src="' . $itemCart->options->img . '" alt="cart products" />
            </a>
            <div class="minicart-product-details">
                <h6>
                    <a href="/products/' . $itemCart->id . '">' . $itemCart->name . '</a>
                </h6>
                <span>' . number_format($itemCart->price) . ' đ x ' . $itemCart->qty . '</span>
            </div>
            <button onclick="removeCart(`' . $itemCart->rowId . '`)" class="close">
                <i class="fa fa-close"></i>
            </button>
        </li>';
        }

        return $text;
    }

    function getPaypalButton()
    {
        $user = Auth::user();
        $text = '<script>paypal.Buttons({
                        createOrder: function (data, actions) {
                            // This function sets up the details of the transaction, including the amount and line item details.
                            return actions.order.create({
                                purchase_units: [
                                    {
                                        amount: {
                                            value: "' . (float) str_replace(',', '', Cart::instance($user)->total(0)) * 0.000043 . '",
                                        },
                                    },
                                ],
                                application_context: {
                                    shipping_preference: "NO_SHIPPING",
                                },
                            });
                        },
                        onApprove: function (data, actions) {
                            // This function captures the funds from the transaction.
                            return actions.order.capture().then(function (details) {
                                // This function shows a transaction success message to your buyer.
                                console.log(details);
                                alert(
                                    "Transaction completed by " +
                                        details.payer.name.given_name
                                );
                            });
                        },
                    })
                    .render("#paypal-button-container");</script>';

        return ['button' => $text];
    }

    function getPaypalButtonDeposit()
    {
        $user = Auth::user();
        $totalPrice = round((float) str_replace(',', '', Cart::instance($user)->total(0)) * 0.000043 / 2, 2);
        $text = '<script>paypal.Buttons({
                        createOrder: function (data, actions) {
                            // This function sets up the details of the transaction, including the amount and line item details.
                            return actions.order.create({
                                purchase_units: [
                                    {
                                        amount: {
                                            value: "' . $totalPrice . '",
                                        },
                                    },
                                ],
                                application_context: {
                                    shipping_preference: "NO_SHIPPING",
                                },
                            });
                        },
                        onApprove: function (data, actions) {
                            // This function captures the funds from the transaction.
                            return actions.order.capture().then(function (details) {
                                // This function shows a transaction success message to your buyer.
                                window.location.replace("/checkout/success");
                                alert(
                                    "Transaction completed by " +
                                        details.payer.name.given_name
                                );
                            });
                        },
                    })
                    .render("#paypal-button-deposit");</script>';
        return ['button' => $text];
    }
}
