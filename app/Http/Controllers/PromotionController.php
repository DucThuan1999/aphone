<?php

namespace App\Http\Controllers;

use App\Products;
use App\Promotions;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    function index()
    {
        $promotions = Promotions::all();

        $promotionsPagination = Promotions::paginate(9);
        return view('Pages.Promotions', ['promotionsPagination' => $promotionsPagination, 'promotions' => $promotions]);
    }
    function single(Request $request)
    {
        $id = $request->id;
        $promotion = Promotions::find($id);
        $productsPromotion = Products::with('promotions')->whereHas('promotions', function ($query) use ($id) {
            $query->where('promotions.id', $id);
        })->get();
        return view('Pages.SinglePromotion', ['promotion' => $promotion, 'productsPromotion' => $productsPromotion]);
    }
}
