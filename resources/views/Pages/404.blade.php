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
                        <h1>404</h1>
                        <h2>Opps! Trang không tồn tại</h2>
                        <p>Xin lỗi nhưng trang bạn đang tìm kiếm không tồn tại hoặc đã đổi tên.</p>
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