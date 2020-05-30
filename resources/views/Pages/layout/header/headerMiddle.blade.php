<?php
    if(Auth::check()){
        $cart = Cart::instance(Auth::user())->content();
    }else{
        $cart = Cart::content();
    }
    
?>
<!-- Begin Header Middle Area -->
<div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
    <div class="container">
        <div class="row">
            <!-- Begin Header Logo Area -->
            <div class="col-lg-3">
                <div class="logo pb-sm-30 pb-xs-30">
                    <a href="/">
                        <img src="{{URL::asset('upload/images/menu/logo/2.jpg')}}" alt="" />
                    </a>
                </div>
            </div>
            <!-- Header Logo Area End Here -->
            <!-- Begin Header Middle Right Area -->
            <div class="col-lg-9">
                <!-- Begin Header Middle Searchbox Area -->
                <form action="{{route('products.index')}}" class="hm-searchbox">
                    <div class="row">
                        <input id="input-search" name="search" type="text" placeholder="Tìm sản phẩm mong muốn ..." />
                        {{ csrf_field() }}

                        <button id="button-search" class="li-btn" type="submit">
                            <i class="fa fa-search"></i>
                        </button>

                        <div id='searchList' style="display:none"></div>
                    </div>
                </form>
                <!-- Header Middle Searchbox Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="header-middle-right">
                    <ul class="hm-menu">
                        <!-- Begin Header Middle Wishlist Area -->
                        <li class="hm-wishlist">
                            <a href="/wishlist">
                                <span id="count_wishlist" class="cart-item-count wishlist-item-count">
                                    @empty($wishlist)
                                    0
                                    @else
                                    {{count($wishlist)}}
                                    @endempty
                                </span>
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </li>
                        <!-- Header Middle Wishlist Area End Here -->
                        @foreach ($cart as $itemCart)

                        @endforeach
                        <!-- Begin Header Mini Cart Area -->
                        <li class="hm-minicart">
                            <div class="hm-minicart-trigger">
                                <span class="item-icon"></span>
                                <span class="item-text">Giỏ hàng
                                    <span id="count_cart" class="cart-item-count">
                                        {{count($cart)}}</span>
                                </span>
                            </div>
                            <span></span>
                            <div class="minicart">
                                <ul class="minicart-product-list">
                                    @foreach ($cart as $itemCart)
                                    <li>
                                        <a href="single-product.html" class="minicart-product-image">
                                            <img src="{{$itemCart->options->img}}" alt="cart products" />
                                        </a>
                                        <div class="minicart-product-details">
                                            <h6>
                                                <a href="/products/{{$itemCart->id}}">{{$itemCart->name}}</a>
                                            </h6>
                                            <span>{{number_format($itemCart->price)}} đ x {{$itemCart->qty}}</span>
                                        </div>
                                        <button class="close">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                                <p class="minicart-total">
                                    TỔNG CỘNG:
                                    <span>{{Cart::total(0)}} đ</span>
                                </p>
                                <div class="minicart-button">
                                    <a href="/cart" class="li-button li-button-dark li-button-fullwidth li-button-sm">
                                        <span>Xem giỏ hàng</span>
                                    </a>
                                    <a href="/checkout" class="li-button li-button-fullwidth li-button-sm">
                                        <span>Thanh toán</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- Header Mini Cart Area End Here -->
                    </ul>
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
            <!-- Header Middle Right Area End Here -->
        </div>
    </div>
</div>
<!-- Header Middle Area End Here -->