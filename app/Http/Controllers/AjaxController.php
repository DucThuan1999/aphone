<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Suppliers;
use App\Images;
use App\Colors;

class AjaxController extends Controller
{
    function getSuplliersByCategory($id)
    {
        $suppliersByCategory = Suppliers::select('suppliers.id', 'suppliers.name')->join('products', 'suppliers.id', '=', 'supplier_id')->where('category_id', $id)->groupBy('suppliers.id', 'suppliers.name')->get();
        $text = '';
        foreach ($suppliersByCategory as $suppliers) {
            $text .= '
            <ul>
                <li><a href="#">' . $suppliers->name . '</a></li>
            </ul>
            ';
        }
        return $text;
    }
    function getProductQuickView($id)
    {
        $product = Products::where('id', $id)->get()[0];
        $images = Images::where('product_id', $id)->get();

        $text = '        
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area row">
                            <div class="col-lg-5 col-md-6 col-sm-6">
                                <!-- Product Details Left -->
                                <div class="product-details-left">
                                    <div class="product-details-images slider-navigation-1">
                                        <br><br>
                                        <div class="lg-image">
                                            <img src="' . $product->image . '" alt="product image" />
                                        </div>                                        
                                    </div>                                    
                                </div>
                                <!--// Product Details Left -->
                            </div>

                            <div class="col-lg-7 col-md-6 col-sm-6">
                                <div class="product-details-view-content pt-60">
                                    <div class="product-info">
                                        <h2>
                                            ' . $product->name . '
                                        </h2>
                                        <span class="product-details-ref">Danh mục: ' . $product->categories->name . '</span>
                                        <div class="rating-box pt-20">
                                            <ul class="rating rating-with-review-item">
                                                <li>
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="no-star">
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="no-star">
                                                    <i class="fa fa-star-o"></i>
                                                </li>                                                
                                            </ul>
                                        </div>
                                        <div class="price-box pt-20">
                                            <span class="new-price new-price-2">' . number_format($product->price) . 'đ</span>
                                        </div>
                                        <div class="product-desc">
                                            <p>
                                                <span>' . $product->content . '
                                                </span>
                                            </p>
                                        </div>
                                        <div class="product-variants">
                                            <div class="produt-variants-size">
                                                <label>Màu sắc </label>
                                                <select class="nice-select">
                                                    <option value="1" title="S" selected="selected">40x60cm</option>
                                                    <option value="2" title="M">60x90cm</option>
                                                    <option value="3" title="L">80x120cm</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="single-add-to-cart">
                                            <form action="#" class="cart-quantity">
                                                <div class="quantity">
                                                    <label>Số lượng</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" value="1" type="text" />
                                                        <div class="dec qtybutton">
                                                            <i class="fa fa-angle-down"></i>
                                                        </div>
                                                        <div class="inc qtybutton">
                                                            <i class="fa fa-angle-up"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="add-to-cart" type="submit">
                                                    Thêm vào giỏ
                                                </button>
                                            </form>
                                        </div>
                                        <div class="product-additional-info pt-25">
                                            <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to
                                                wishlist</a>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        ';
        return $text;
    }
    function getColors()
    {
        $colors = Colors::all();
        return $colors;
    }

    function getColorsByProduct($id)
    {
        $colors = Colors::with('products')->whereHas('products', function ($query) use ($id) {
            $query->where('products.id', $id);
        })->get();

        $text = '<option selected disable value="">Chọn màu</option>';

        foreach ($colors as $color) {
            $text .= '<option value="' . $color->id . '">' . $color->name . ' (' . $color->products->first()->pivot->quantity . ')</option>';
        };

        return $text;
    }

    function suggestSearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Products::where('name', 'LIKE', '%' . $query . '%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; padding: 20px">';

            foreach ($data as $row) {
                $output .= '<li><a href="/products/' . $row->id . '">' . $row->name . '</a></li>';
            }
            $output .= '</ul>';

            return $output;
        }
    }
}
