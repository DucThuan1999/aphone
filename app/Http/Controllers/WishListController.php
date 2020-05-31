<?php

namespace App\Http\Controllers;

use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $wishlist = WishList::where('user_id', $user->id)->get();
            return view('Pages.Wishlist', ['wishlist' => $wishlist]);
        } else
            return view('Pages.Wishlist', ['wishlist' => []]);


        // return $wishlist;
    }

    function addWishList(Request $request)
    {
        $wishlist = new WishList();
        if (Auth::check()) {
            $wishlist->user_id = Auth::user()->id;
            $wishlist->product_id = $request->id;
            $wishlist->save();
            return $wishlist;
        } else
            return redirect('/login')->with('loginAlert', 'Vui lòng đăng nhập để thêm sản phẩm yêu thích !!!');
    }

    function removeWishList(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $wishlist = WishList::where('user_id', $user->id)->where('product_id', $request->id)->delete();
        }
        return response('success', 200);
    }
}
