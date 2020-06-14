@php
if($product->promotions->first()){
if($product->promotions->first()->pivot->type_discount == 'percent'){
$percent = $product->promotions->first()->pivot->percent;
$new_price = $product->price * (1 - $percent / 100);
}
if($product->promotions->first()->pivot->type_discount == 'price'){
$price_discount = $product->promotions->first()->pivot->price_discount;
$new_price = $product->price -$price_discount;
}

}
@endphp
<!-- content-wraper start -->
<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
                        @foreach ($images as $image)
                        <div class="lg-image">
                            <img src="{{$image->url}}" alt="product image">
                        </div>
                        @endforeach
                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">
                        @foreach ($images as $image)
                        <div class="sm-image"><img src="{{$image->url}}" alt="product image thumb">
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content sp-normal-content pt-60">
                    <div class="product-info">
                        <h2>{{$product->name}}</h2>
                        <span class="product-details-ref">Danh mục: {{$product->categories->name}}</span>
                        <div class="rating-box pt-20">
                            <ul class="rating rating-with-review-item">
                                @for($i=0;$i< 5;$i++) @if($i<$product->rate)
                                    <li><i class="fa fa-star-o"></i></li>
                                    @else
                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                    </li>
                                    @endif
                                    @endfor
                            </ul>
                        </div>
                        @if($product->status == 1)
                        <div class="price-box pt-20">
                            @empty($product->promotions->first())
                            <span class="new-price new-price-2">{{number_format($product->price)}} đ</span>
                            @else
                            <span class="new-price new-price-2">{{number_format($new_price)}} đ</span>&nbsp;
                            <span class="old-price"
                                style="text-decoration: line-through">{{number_format($product->price)}} đ</span>
                            @endempty
                        </div>
                        @else
                        <br>
                        <h4 class="text-danger">Ngừng kinh doanh</h4>
                        @endif
                        <div class="product-desc">
                            <p>
                                <span>{{$product->content}}
                                </span>
                            </p>
                        </div>
                        @if($product->status == 1)
                        <div class="product-variants">
                            <div class="produt-variants-size">
                                <label>Màu sắc</label>
                                <select id="select-colors" class="nice-select">
                                </select>
                            </div>
                        </div>

                        <div class="single-add-to-cart">
                            <span id="color-alert" class="text-danger"></span>
                            <form action="#" class="cart-quantity">
                                <div class="quantity">
                                    <br>
                                    <label>Số lượng</label>
                                    <div class="cart-plus-minus">
                                        <input id="input_qty" type="number" class="cart-plus-minus-box" value="1"
                                            type="text"><br>
                                        {{-- <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div> --}}
                                    </div>

                                </div>
                                @empty(!$product->promotions->first())
                                @if($product->promotions->first()->pivot->type_discount == 'percent')
                                <button onclick="addCart({{$product->id}},{{$percent}})" class=" add-to-cart"
                                    type="button" style="font-weight:bold">Thêm vào giỏ</button>

                                @else
                                <button onclick="addCart({{$product->id}})" class=" add-to-cart" type="button"
                                    style="font-weight:bold">Thêm vào giỏ</button>
                                @endif
                                @else
                                <button onclick="addCart({{$product->id}})" class=" add-to-cart" type="button"
                                    style="font-weight:bold">Thêm vào giỏ</button>
                                @endempty
                            </form>
                        </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wraper end -->