<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Categories;
use App\Suppliers;
use App\Images;
use App\Promotions;
use App\WishList;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    function __construct()
    {

        $products = Products::all();
        $categories = Categories::all();
        $suppliers = Suppliers::all();
        $promotions = Promotions::all()->random();
        $twoPromotions = Promotions::all()->random(2);
        $promotion_id = $promotions->id;

        $randomProductsArea = Products::all()->random(6);

        $productsPromotion = Products::with('promotions')->whereHas('promotions', function ($query) {
            $query->whereNotNull('promotions.id');
        })->get();

        view()->share('products', $products);
        view()->share('categories', $categories);
        view()->share('suppliers', $suppliers);

        view()->share('randomProductsArea', $randomProductsArea);
        view()->share('promotions', $promotions);
        view()->share('twoPromotions', $twoPromotions);
        view()->share('productsPromotion', $productsPromotion);
    }

    function index()
    {
        if (Auth::check()) {
            if (Auth::user()->email_verified_at === null) {
                return view('Pages.VerifyAlert');
            }
            $wishlist = WishList::where('user_id', Auth::user()->id)->get();
            view()->share('wishlist', $wishlist);
        }
        return view('Pages.Home');
    }

    function getProductById($id)
    {
        if (!is_null($id)) {
            $product = Products::find($id);
            $encloseProducts = Products::where('category_id', $product->category_id)->get();
            $images = Images::where('product_id', $id)->get();

            return view('Pages.SingleProduct', ['product' => $product, 'encloseProducts' => $encloseProducts, 'images' => $images]);
        } else
            return null;
    }
}
