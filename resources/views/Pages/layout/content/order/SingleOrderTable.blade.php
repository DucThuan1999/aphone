<!--Wishlist Area Strat-->
<div class="wishlist-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        @empty($bill)

                        <div class="error-wrapper text-center ptb-50 pt-xs-20">
                            <div class="error-text">
                                <p>Đơn hàng trống</p>
                            </div>
                            <div class="error-button">
                                <a href="/">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                        @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-product-name">Mã sản phẩm</th>
                                    <th class="cart-product-name">Hình ảnh</th>
                                    <th class="cart-product-name">Tên sản phẩm</th>
                                    <th class="li-product-quantity">Màu sắc</th>
                                    <th class="li-product-price">Đơn giá</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bill->first()->info_bills as $itemBill)

                                <tr>
                                    <td class="li-product-remove"><a>{{$itemBill->product_id}}</a></td>
                                    <td class="li-product-thumbnail"><a href="/products/{{$itemBill->product_id}}"><img
                                                height="150px" src="{{$itemBill->product->image}}"
                                                alt="Li's Product Image"></a>
                                    </td>
                                    <td class="li-product-name"><a
                                            href="/products/{{$itemBill->product->id}}">{{$itemBill->product->name}}</a>
                                    </td>
                                    <td class="li-product-name">{{$itemBill->color->name}}
                                    </td>
                                    <td class="li-product-price"><span class="amount">
                                            {{number_format($itemBill->product->price)}} đ
                                        </span></td>
                                    <td class="quantity">
                                        {{-- <label>Số lượng</label> --}}
                                        <div class=" li-product-price">
                                            <div class="produt-variants-size">
                                                {{$itemBill->qty}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span
                                            class="amount">{{number_format($itemBill->price)}}
                                            đ</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div id="showTotalPrice" class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Tổng cộng đơn hàng</h2>
                                    <ul>
                                        <li>Tổng tiền <span>{{number_format($bill->first()->total)}} đ</span></li>
                                        <li>Thành tiền
                                            <span>{{number_format($bill->first()->total -$bill->first()->total_discount)}}
                                                đ</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endempty
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Wishlist Area End-->