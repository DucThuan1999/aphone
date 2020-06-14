<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span id="button-category">{{$title}}</span>
                    </h2>
                    <ul class="li-sub-category-list">
                        @foreach ($categories as $category)
                        <li class="active"><a
                                href="{{route('products.index',['categories'=> $category->id])}}">{{$category->name}}</a>
                        </li>
                        @endforeach
                        {{-- <li class="active"><a href="shop-left-sidebar.html">Prime Video</a></li>
                        <li><a href="shop-left-sidebar.html">Computers</a></li>
                        <li><a href="shop-left-sidebar.html">Electronics</a></li> --}}
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel" id="products-area">
                        @foreach ($products as $product)
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
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="/products/{{$product->id}}">
                                        <img src="{{$product->image}}" alt="Li's Product Image">
                                    </a>
                                    @empty($product->promotions->first()->pivot->type_discount)
                                    @else
                                    @if($product->promotions->first()->pivot->type_discount == 'percent')
                                    <span class="sticker ">-{{$percent}}%</span>
                                    @endif
                                    @endempty
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a>{{$product->categories->name}}</a>
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
                                            <span class="new-price">{{number_format($product->price)}}đ</span>
                                            @else
                                            <span class="new-price new-price-2">{{number_format($new_price)}}
                                                đ</span>
                                            <span class="old-price">{{number_format($product->price)}} đ</span>
                                            @endempty
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            {{-- <li class="add-cart active"><a onclick="addCart({{$product->id}})">Thêm
                                            vào
                                            giỏ</a></li> --}}
                                            {{-- <li><a onclick="addWishList({{$product->id}}) "
                                            class="links-details"><i class="fa fa-heart-o"></i></a></li> --}}
                                            <li><a @if(!Auth::check()) href="/login" @endif
                                                    onclick="addWishList({{$product->id}})" class="links-details"><i
                                                        class="fa fa-heart-o"></i></a></li>
                                            <li><a onclick="quickviewModal({{$product->id}})" data-toggle="modal"
                                                    class="quick-view"><i class="fa fa-eye"></i></a>
                                            </li>
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
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->

{{-- @include('Pages.layout.content.QuickView'); --}}