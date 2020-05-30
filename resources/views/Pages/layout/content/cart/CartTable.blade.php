<?php
    if(Auth::check()){
        $cart = Cart::instance(Auth::user())->content();
    }else{
        $cart = Cart::content();
    }    
?>
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($cart->count() != 0)
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">Xoá</th>
                                    <th class="li-product-thumbnail">Ảnh</th>
                                    <th class="cart-product-name">Tên sản phẩm</th>
                                    <th class="li-product-quantity">Màu sắc</th>
                                    <th class="li-product-price">Đơn giá</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $itemCart)
                                <tr id="products_row_{{$itemCart->rowId}}">
                                    <td class="li-product-remove"><a onclick="removeCart('{{$itemCart->rowId}}')"
                                            href="javascript:void(0)"><i class="fa fa-times"></i></a></td>
                                    <td class="li-product-thumbnail"><a href="/products/{{$itemCart->id}}"><img
                                                width="150px" src="{{$itemCart->options->img}}"
                                                alt="Li's Product Image"></a></td>
                                    <td class="li-product-name"><a
                                            href="/products/{{$itemCart->id}}">{{$itemCart->name}}</a></td>
                                    <td class="quantity">
                                        {{-- <label>Số lượng</label> --}}
                                        <div class="cart-plus-minus">
                                            <div class="produt-variants-size">
                                                <select id="select_colors_{{$itemCart->rowId}}" class="nice-select">
                                                    <option disabled selected>Màu</option>
                                                    @foreach ($itemCart->options->colors as $color)
                                                    @if($color->id ==
                                                    $itemCart->options->colorSelected)
                                                    <option selected value="{{$color->id}}">
                                                        {{$color->name}}({{$color->products->first()->pivot->quantity}})
                                                    </option>
                                                    @else
                                                    <option value="{{$color->id}}">
                                                        {{$color->name}}({{$color->products->first()->pivot->quantity}})
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                {{-- {{dd($itemCart->options->colors)}} --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="li-product-price"><span
                                            class="amount">{{number_format($itemCart->price)}} đ</span></td>
                                    <td class="quantity">
                                        {{-- <label>Số lượng</label> --}}
                                        <div class="cart-plus-minus">
                                            <input type="hidden" value="{{$itemCart->rowId}}">
                                            <input type="number" min="1"
                                                onchange="updateQtyItemCart('{{$itemCart->rowId}}',this.value)"
                                                class="cart-plus-minus-box" value="{{$itemCart->qty}}" type="text">

                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span class="amount"
                                            id="subtotal_{{$itemCart->rowId}}">{{number_format($itemCart->subtotal)}}
                                            đ</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div id="showTotalPrice" class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Tổng cộng giỏ hàng</h2>
                                <ul>
                                    <li>Tổng tiền <span>{{Cart::priceTotal()}}</span></li>
                                    <li>Thành tiền <span>{{Cart::total()}}</span></li>
                                </ul>
                                <a href="/checkout">Tiến hành thanh toán</a>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <div class="error-wrapper text-center ptb-50 pt-xs-20">
                    <div class="error-text">
                        <p>Giỏ hàng trống.</p>
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
<!--Shopping Cart Area End-->
@section('script')
<script>
    function removeCart(rowId){                
        $.ajax({
            method: "POST",
            url: '/cart/remove',
            data: {
                rowId: rowId,                
                inCartPage: true
            }
        }).done(function(data){            
            $(`#products_row_${rowId}`).hide();   
            showSnackbar("Đã xoá sản phẩm trong giỏ hàng !!!");

            let count_cart = document.getElementById('count_cart');
            count_cart.innerText = parseInt(count_cart.textContent) - 1; 
            if(data) $('#showTotalPrice').html(data);                                   
        });
    }
    
    function updateQtyItemCart(rowId,qty){    
        $.ajax({
            method: "POST",
            url: '/cart/update',
            data: {
                rowId,
                qty,
                inCartPage: true
            }
        }).done(function(data){
            showSnackbar("Đã cập nhật sản phẩm trong giỏ hàng !!!");            
            if(data) {
                $('#showTotalPrice').html(data.totalPrice); 
                $(`#subtotal_${rowId}`).html(data.subtotal+' đ');
           }   
            // console.log(data);        
        });
    }

    function getColorsProduct(id,rowId){        
        $.get("/ajax/colors/getcolorsbyproduct/" + id, function (data) {
            $(`#select_colors_${rowId}`).html(data);
            $(".nice-select").niceSelect();
        });
    
    };
</script>
@endsection