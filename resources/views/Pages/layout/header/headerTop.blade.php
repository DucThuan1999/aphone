<!-- Begin Header Top Area -->
<div class="header-top">
    <div class="container">
        <div class="row">
            <!-- Begin Header Top Left Area -->
            <div class="col-lg-3 col-md-4">
                <div class="header-top-left">
                    <ul class="phone-wrap">
                        <li><span>Điện thoại:</span><a href="#">(+123) 123 321 3345</a></li>
                    </ul>
                </div>
            </div>
            <!-- Header Top Left Area End Here -->
            <!-- Begin Header Top Right Area -->
            <div class="col-lg-9 col-md-8">
                <div class="header-top-right">
                    <ul class="ht-menu">
                        @if(Auth::check())
                        <li>
                            <div><a class="a-custom" href="/infouser">{{Auth::user()->firstname}}
                                    {{Auth::user()->lastname}}</a></div>
                        </li>
                        <li>
                            <div><a class="a-custom" href="/logout">Đăng xuất</a></div>
                        </li>
                        @else
                        <li>
                            <div><a class="a-custom" href="/register">Đăng ký</a></div>
                        </li>
                        <li>
                            <div><a class="a-custom" href="/login">Đăng nhập</a></div>
                        </li>
                        @endif
                        {{-- <!-- Begin Setting Area -->
                        <li>
                            <div class="ht-setting-trigger"><span>Tài khoản</span></div>
                            <div class="setting ht-setting">
                                @if(Auth::check())
                                <ul>
                                    <li><a href="/infouser">{{Auth::user()->firstname}}
                        {{Auth::user()->lastname}}</a></li>
                        <li><a href="/logout">Đăng xuất</a></li>
                    </ul>
                    @else
                    <ul class="ht-setting-list">
                        <li><a href="/register">Đăng ký</a></li>
                        <li><a href="/login">Đăng nhập</a></li>
                    </ul>
                    @endif
                </div>
                </li>
                <!-- Setting Area End Here --> --}}
                </ul>
            </div>
        </div>
        <!-- Header Top Right Area End Here -->
    </div>
</div>
</div>
<!-- Header Top Area End Here -->