<!--Wishlist Area Strat-->
<div class="wishlist-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(count($wishlist) != 0)
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">Xoá</th>
                                    <th class="li-product-thumbnail">Ảnh</th>
                                    <th class="cart-product-name">Tên sản phẩm</th>
                                    <th class="li-product-price">Giá</th>
                                    <th class="li-product-add-cart">Thêm vào giỏ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlist as $wishitem)
                                <tr id="products_row_{{$wishitem->products->id}}">
                                    <td class="li-product-remove"><a
                                            onclick="handleRemoveWishlist({{$wishitem->products->id}})"
                                            href="javascript:void(0);"><i class="fa fa-times"></i></a></td>
                                    <td class="li-product-thumbnail"><a href="#"><img width="120px"
                                                src="{{$wishitem->products->image}}" alt=""></a></td>
                                    <td class="li-product-name"><a
                                            href="/products/{{$wishitem->products->id}}">{{$wishitem->products->name}}</a>
                                    </td>
                                    <td class="li-product-price"><span
                                            class="amount">{{number_format($wishitem->products->price)}}
                                            đ</span></td>
                                    <td class="li-product-add-cart"><a
                                            onclick="addCart({{$wishitem->products->id}})">Thêm vào giỏ</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                @else
                <div class="error-wrapper text-center ptb-50 pt-xs-20">
                    <div class="error-text">
                        <p>Danh sách yêu thích trống.</p>
                    </div>
                    <div class="error-button">
                        <a href="/">Tiếp tục mua sắm</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--Wishlist Area End-->