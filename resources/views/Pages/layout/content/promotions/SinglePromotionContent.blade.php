<!-- Begin Li's Main Blog Page Area -->
<div class="li-main-blog-page li-main-blog-details-page pt-60 pb-60 pb-sm-45 pb-xs-45">
    <div class="container">
        <div class="row">

            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-12 order-lg-2 order-1" style="margin: auto">
                <div class="row li-main-content">
                    <div class="col-lg-12">
                        <div class="li-blog-single-item pb-30">
                            <div class="li-blog-banner">
                                <a href="blog-details.html"><img class="img-full" src="{{$promotion->poster}}"
                                        alt=""></a>
                            </div>
                            <div class="li-blog-content">
                                <div class="li-blog-details">
                                    <h3 class="li-blog-heading pt-25"><a href="#">{{$promotion->title}}</a></h3>
                                    <div class="li-blog-meta">
                                        Thời gian khuyến mãi: &nbsp;<a class="post-time"><i class="fa fa-calendar"></i>
                                            {{date_format(date_create($promotion->start_at), 'd/m/y')}} </a>- &nbsp;
                                        <a class="post-time"><i
                                                class="fa fa-calendar"></i>{{date_format(date_create($promotion->end_at), 'd/m/y')}}</a>
                                    </div>
                                    {{-- <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean
                                        posuere libero eu augue condimentum rhoncus. Cras pretium arcu ex.</p> --}}
                                    <!-- Begin Blog Blockquote Area -->
                                    <div class="li-blog-blockquote">
                                        <blockquote>
                                            <p>{{$promotion->description}}</p>
                                        </blockquote>
                                    </div>
                                    <!-- Blog Blockquote Area End Here -->
                                    {{-- <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean
                                        posuere libero eu augue condimentum rhoncus. Cras pretium arcu ex. Lorem ipsum
                                        dolor sit amet consectetur adipisicing elit. Dolorum laborum in labore Donec
                                        vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean
                                        posuere libero eu augue condimentum rhoncus. Cras pretium arcu ex. Lorem ipsum
                                        dolor sit amet consectetur adipisicing elit. Dolorum laborum in labore rerum
                                        Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean
                                        posuere libero eu augue condimentum rhoncus. Cras pretium arcu ex. Lorem ipsum
                                        dolor sit amet consectetur adipisicing elit. Dolorum laborum in labore rerum
                                    </p> --}}

                                    <!--Wishlist Area Strat-->
                                    <div class="wishlist-area pt-30">
                                        <div class="container">
                                            <h4 class="mb-20" style="text-align: center">Danh sách các sản phẩm được
                                                khuyến mãi</h4>
                                            <div class="row">
                                                <div class="col-12">
                                                    <form action="#">
                                                        <div class="table-content table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="li-product-remove">STT</th>
                                                                        <th class="li-product-thumbnail">Ảnh</th>
                                                                        <th class="cart-product-name">Tên Sản Phẩm</th>
                                                                        @if($promotion->promotions_products->type_discount
                                                                        == "percent")
                                                                        <th class="li-product-remove">Phần trăm</th>
                                                                        @endif
                                                                        <th class="li-product-remove">Tiền giảm</th>
                                                                        <th class="li-product-price">Giá Gốc</th>
                                                                        <th class="li-product-stock-status">Giá Giảm
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($productsPromotion as $index=>$product)
                                                                    <?php 
                                                                     if($promotion->promotions_products->type_discount === "percent"){
                                                                        $percent = $product->promotions->first()->pivot->percent;
                                                                        $price_discount = $product->price * $percent /100;
                                                                     }else {
                                                                        $price_discount =$product->promotions->first()->pivot->price_discount;
                                                                     }
                                                                     
                                                                     $price_discounted = $product->price - $price_discount;
                                                                    ?>
                                                                    <tr>
                                                                        <td class="li-product-remove">
                                                                            <a>{{$index+1}}</a></td>
                                                                        <td class="li-product-thumbnail"><a
                                                                                href="/products/{{$product->id}}"><img
                                                                                    height="150px"
                                                                                    src="{{$product->image}}"
                                                                                    alt=""></a></td>
                                                                        <td class="li-product-name"><a
                                                                                href="/products/{{$product->id}}">{{$product->name}}</a>
                                                                        </td>
                                                                        @if($promotion->promotions_products->type_discount
                                                                        === "percent")
                                                                        <td class="li-product-name"><a
                                                                                href="/products/{{$product->id}}">{{$percent}}%</a>
                                                                        </td>
                                                                        @endif
                                                                        <td class="li-product-stock-status"><span
                                                                                class="in-stock">{{number_format($price_discount)}}
                                                                                đ</span></td>
                                                                        <td class="li-product-price"><span
                                                                                class="amount">{{number_format($product->price)}}
                                                                                đ</span>
                                                                        </td>
                                                                        <td class="li-product-stock-status"><span
                                                                                class="out-stock">{{number_format($price_discounted)}}
                                                                                đ</span>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Li's Main Content Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Main Blog Page Area End Here -->