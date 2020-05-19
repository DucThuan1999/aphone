@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Trang không tồn tại'])


<!-- Error 404 Area Start -->
<div class="error404-area pt-30 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-wrapper text-center ptb-50 pt-xs-20">
                    <div class="error-text">
                        <h2>Tài khoản của bạn đã được xác nhận</h2>
                        <p>Bây giờ bạn có thể sử dụng tài khoản của mình .</p>
                    </div>
                    <div class="error-button">
                        <a href="/login">Tiến hành đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Error 404 Area End -->

@endsection