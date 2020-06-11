<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Info_products;

class CompareController extends Controller
{
    public function index()
    {
        $product = Products::all();
        return view('Pages.Compare',['product',$product]);
    }
   public function compare(Request $request)
    {
        if($request->ajax()){
            if ($request->get('search')) {
                $query= $request->get('search');
                $products=Products::join('Info_products', 'Products.id', '=', 'Info_products.product_id')->join('Colors_Products','Products.id','=','Colors_Products.product_id')->join('Colors','Colors_Products.color_id','=','Colors.id')->where('Products.name',$query)->get();
                return $products;
            }
        }
        // return Response($output);
    } 
}
