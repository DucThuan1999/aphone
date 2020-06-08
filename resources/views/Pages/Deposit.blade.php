@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Đặt cọc'])
<!-- Error 404 Area Start -->
<div class="error404-area pt-30 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-wrapper text-center ptb-50 pt-xs-20">
                    <div class="error-text">
                        <h2>Đơn hàng của bạn đã được ghi nhận.</h2>
                        <p>Để xác thực đơn hàng, bạn vui lòng đặt cọc 50% tổng giá trị đơn hàng. Đơn hàng sẽ được chuyển
                            ngay khi chúng tôi nhận được tiền đặt cọc.</p>
                    </div>
                    <div class="error-button">
                        <div id="paypal-button-deposit"></div>
                        <div id="paypal-button-deposit-script"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Error 404 Area End -->

@endsection