<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-2">
                @include('Pages.layout.content.products.Banner')

                @include('Pages.layout.content.products.TopBar',['productsPagination'=>$productsPagination])
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    @foreach($productsPagination as $product)
                                    @empty($product->promotions->first()->pivot->type_discount)
                                    @else
                                    @php
                                    switch ($product->promotions->first()->pivot->type_discount) {
                                    case 'percent':
                                    $percent = $product->promotions->first()->pivot->percent;
                                    $new_price = $product->price * (1 - $percent / 100);
                                    break;
                                    case 'price':
                                    $price_discount = $product->promotions->first()->pivot->price_discount;
                                    $new_price = $product->price - $price_discount;
                                    break;

                                    default:
                                    break;
                                    }
                                    @endphp
                                    @endempty
                                    <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="/products/{{$product->id}}">
                                                    <img src="{{$product->image}}" alt="Li's Product Image">
                                                </a>
                                                @empty($product->promotions->first()->pivot->type_discount)
                                                @else
                                                @if($product->promotions->first()->pivot->type_discount == 'percent')
                                                <span
                                                    class="sticker ">-{{$product->promotions->first()->pivot->percent}}%</span>
                                                @endif
                                                @endempty
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a
                                                                href="{{route('products.index',['categories'=> $product->category_id])}}">{{$product->categories->name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                @for($i=0;$i< 5;$i++) @if($i<$product->rate)
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    @else
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    @endif
                                                                    @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name"
                                                            href="/products/{{$product->id}}">{{$product->name}}</a>
                                                    </h4>
                                                    <div class="price-box">
                                                        @empty($product->promotions->first()->pivot->type_discount)
                                                        <span
                                                            class="new-price">{{number_format($product->price)}}đ</span>
                                                        @else
                                                        <span
                                                            class="new-price new-price-2">{{number_format($new_price)}}
                                                            đ</span>
                                                        <span class="old-price">{{number_format($product->price)}}
                                                            đ</span>
                                                        @endempty
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        {{-- <li class="add-cart active"><a
                                                                onclick="addCart({{$product->id}})">Thêm
                                                        vào
                                                        giỏ</a></li> --}}
                                                        <li><a onclick="quickviewModal({{$product->id}})"
                                                                title="quick view" class="quick-view-btn"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                        <li><a class="links-details"
                                                                onclick="addWishList({{$product->id}})"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                            <div class="row">
                                <div class="col">
                                    @foreach($productsPagination as $product)
                                    <div class="row product-layout-list">
                                        <div class="col-lg-3 col-md-5 ">
                                            <div class="product-image">
                                                <a href="/products/{{$product->id}}">
                                                    <img src="{{$product->image}}" alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">Mới</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-7">
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a
                                                                href="{{route('products.index',['categories'=> $product->category_id])}} ">{{$product->categories->name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                @for($i=0;$i< 5;$i++) @if($i<$product->rate)
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    @else
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    @endif
                                                                    @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name"
                                                            href="/products/{{$product->id}}">{{$product->name}}</a>
                                                    </h4>
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price">{{number_format($product->price)}}đ</span>
                                                    </div>
                                                    <p>{{$product->content}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="shop-add-action mb-xs-30">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart"><a onclick="addCart({{$product->id}})"
                                                            href="javacript:void(0)">Thêm vào giỏ</a></li>
                                                    <li class="wishlist"><a href="wishlist.html"><i
                                                                class="fa fa-heart-o"></i>Yêu thích</a></li>
                                                    <li><a onclick="quickviewModal({{$product->id}})"
                                                            href="javascript:void(0)" class="quick-view"><i
                                                                class="fa fa-eye"></i>Xem nhanh</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @include('Pages.layout.content.products.Pagination',['productsPagination'=>$productsPagination,'resultProducts'=>$resultProducts])
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
            @include('Pages.layout.content.products.FilterSide',['categories'=>$categories,'suppliers'=>$suppliers])
        </div>
    </div>
</div>
<!-- Content Wraper Area End Here -->