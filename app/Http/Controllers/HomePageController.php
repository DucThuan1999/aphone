<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Categories;
use App\Suppliers;
use App\Images;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    function __construct()
    {
        $this->middleware('verified');
        $products = Products::all();
        $categories = Categories::all();
        $suppliers = Suppliers::all();

        $randomProductsArea = Products::all()->random(6);

        view()->share('products', $products);
        view()->share('categories', $categories);
        view()->share('suppliers', $suppliers);

        view()->share('randomProductsArea', $randomProductsArea);
    }

    function index()
    {
        if (Auth::check()) {
            $this->middleware(['auth', 'verified']);
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
