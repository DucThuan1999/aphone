<!-- Begin Footer Static Middle Area -->
<div class="footer-static-middle">
    <div class="container">
        <div class="footer-logo-wrap pt-50 pb-35">
            <div class="row">
                <!-- Begin Footer Logo Area -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-logo">
                        <img src="{{URL::asset('upload/images/menu/logo/1.jpg')}}" alt="Footer Logo" />
                    </div>
                    <ul class="des mt-30">
                        <li>
                            <span>Địa chỉ: </span>
                            273 An Duong Vương, phường 12, quận 5, TPHCM
                        </li>
                        <li>
                            <span>Điện thoại: </span>
                            <a href="#">0856305820</a>
                        </li>
                        <li>
                            <span>Email: </span>
                            <a href="mailto://info@yourdomain.com">info@yourdomain.com</a>
                        </li>
                    </ul>
                </div>
                <!-- Footer Logo Area End Here -->
                <!-- Begin Footer Block Area -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer-block">
                        <h3 class="footer-block-title">
                            Sản phẩm
                        </h3>
                        <ul>
                            <li><a href="#">Hàng giảm giá</a></li>
                            <li>
                                <a href="#">Sản phẩm mới</a>
                            </li>
                            <li><a href="#">Hàng bán chạy</a></li>
                            <li><a href="#">Liên hệ chúng tôi</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer Block Area End Here -->
                <!-- Begin Footer Block Area -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer-block">
                        <h3 class="footer-block-title">
                            Về Công ty
                        </h3>
                        <ul>
                            <li><a href="#">Vận chuyển</a></li>
                            <li>
                                <a href="#">Điều khoản</a>
                            </li>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Liên hệ chúng tôi</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer Block Area End Here -->
                <!-- Begin Footer Block Area -->
                <div class="col-lg-4">

                    <!-- Begin Footer Newsletter Area -->
                    <div class="footer-newsletter">
                        @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}<br>
                        </div>
                        @endif
                        <h4>Đăng ký để nhận tin sớm nhất</h4>
                        <form action="/thien" method="post">
                            @csrf
                            <div id="mc_embed_signup_scroll">
                                <div id="mc-form" class="mc-form subscribe-form form-group">
                                    <input name="txtEmail" id="mc-email" type="email" autocomplete="off"
                                        placeholder="Nhập email" />
                                    <button type="submit" class="btn">
                                        Theo dõi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Footer Newsletter Area End Here -->
                </div>
                <!-- Footer Block Area End Here -->
            </div>
        </div>
    </div>
</div>
<!-- Footer Static Middle Area End Here -->