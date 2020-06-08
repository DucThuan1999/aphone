@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Thanh toán thành công'])


<!-- Error 404 Area Start -->
<div class="error404-area pt-30 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-wrapper text-center ptb-50 pt-xs-20">
                    <div class="error-text">
                        <h2>Đơn hàng của bạn đã được ghi nhận.</h2>
                        <p>Chúng tôi sẽ thông báo email cho bạn ngay khi chúng tôi tiến hành vận chuyển.</p>
                    </div>
                    <div class="error-button">
                        <a href="/">Quay về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Error 404 Area End -->

@endsection