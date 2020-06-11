<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Suppliers;
use App\Images;
use App\Colors;
use App\District;
use App\Providers\DistrictServiceProvider;
use App\Province;
use App\Ward;
use Gloudemans\Shoppingcart\Facades\Cart;

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
        $product = Products::where('id', $id)->first();
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
                                        <div class="single-add-to-cart">
                                            <form action="#" class="cart-quantity" style="margin-top: 0px">
                                                <button class="add-to-cart" type="button">
                                                    Yêu thích
                                                </button>
                                                <button class="add-to-cart" type="button">
                                                    Thêm vào giỏ
                                                </button>
                                            </form>
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
            $text .= '<option value="' . $color->id . '">' . $color->name . ' (' . $color->products->where('id', $id)->first()->pivot->quantity . ')</option>';
        };

        return $text;
    }

    function getQtyByColors(Request $request)
    {
        $idProduct = $request->id;
        $idColor = $request->color;
        $color = Colors::where('id', $idColor)->with('products')->whereHas('products', function ($query) use ($idProduct) {
            $query->where('products.id', $idProduct);
        })->first();

        $qty = $color->products->where('id', $idProduct)->first()->pivot->quantity;

        return ['color' => $color, 'qty' => $qty];
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

    function suggestSearch1(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Products::where('name', 'LIKE', '%' . $query . '%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; padding: 20px; min-width:17rem" >';

            foreach ($data as $row) {
                $output .= '<li class="li1"><i class="i1">' . $row->name . '</i></li>';
            }
            $output .= '</ul>';

            return $output;
        }
    }
    function suggestSearch2(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Products::where('name', 'LIKE', '%' . $query . '%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; padding: 20px; min-width:17rem" >';

            foreach ($data as $row) {
                $output .= '<li class="li2"><i class="i1">' . $row->name . '</i></li>';
            }
            $output .= '</ul>';

            return $output;
        }
    }

    function getLocation()
    {
        $provices = Province::all();
        $districts = District::all();
        $wards = Ward::all();

        return ['provices' => $provices, 'districts' => $districts, 'wards' => $wards];
    }

    function getProvince()
    {
        $provices = Province::all();
        return $provices;
    }

    function getDistrictByProvince($id)
    {
        $districts = District::where('_province_id', $id)->get();
        $text = '<option disabled selected>Quận huyện</option>';

        foreach ($districts as $district) {
            $text .= '<option value="' . $district->id . '">' . $district->_name . '</option>';
        }

        return $text;
    }

    function getWardByDistrict($id)
    {
        $wards = Ward::where('_district_id', $id)->get();
        $text = '<option disabled selected>Phường xã</option>';

        foreach ($wards as $ward) {
            $text .= '<option value="' . $ward->id . '">' . $ward->_name . '</option>';
        }

        return $text;
    }
}
