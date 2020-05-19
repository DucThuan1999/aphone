@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Tài khoản chưa xác nhận email'])


<!-- Error 404 Area Start -->
<div class="error404-area pt-30 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-wrapper text-center ptb-50 pt-xs-20">
                    <div class="error-text">
                        <h2>Tài khoản của bạn chưa xác nhận email</h2>
                        <p>Vui lòng xác nhận để được tiếp tục.</p>
                    </div>
                    <div class="error-button">
                        <a href="/logout">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Error 404 Area End -->

@endsection