<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xs-12" style="margin: auto">
                <form style="margin-top: 4em" action="/register" method="POST">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Đăng ký</h4>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-20">
                                <label>Họ:</label>
                                <input name="first_name" class="mb-0" type="text" placeholder="Nhập họ">
                            </div>
                            <div class="col-md-6 col-12 mb-20">
                                <label>Tên:</label>
                                <input name="last_name" class="mb-0" type="text" placeholder="Nhập tên">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Email:</label>
                                <input name="email" class="mb-0" type="email" placeholder="Nhập email">
                            </div>
                            <div class="col-md-4 mb-20">
                                <label>Tỉnh / Thành phố:</label>
                                <select onchange="changeCity()" class="nice-select" name="province" id="select_city">
                                    <option disabled selected>Tỉnh / Thành phố </option>
                                    @if($provinces)
                                    @foreach ($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 mb-20">
                                <label>Quận huyện:</label>
                                <select onchange="changeDistrict()" class="nice-select-custom" name="district"
                                    id="select_district">
                                    <option disabled selected>Quận huyện</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-20">
                                <label>Phường xã:</label>
                                <select class="nice-select-custom" name="ward" id="select_ward">
                                    <option disabled selected>Phường xã</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Địa chỉ:</label>
                                <input name="street" class="mb-0" type="text" placeholder="Nhập địa chỉ">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Sđt:</label>
                                <input name="phone" class="mb-0" type="text" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Mật khẩu:</label>
                                <input name="password" class="mb-0" type="password"
                                    placeholder="Mật khẩu từ 6 - 32 ký tự">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Xác nhận mật khẩu:</label>
                                <input name="confirm_password" class="mb-0" type="password"
                                    placeholder="Nhập lại mật khẩu">
                            </div>
                            @if(count($errors)>0)
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    {{$errors->first()}}
                                </div>
                            </div>
                            @endif

                            @if(session('registerAlert'))
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    {{session('registerAlert')}}
                                </div>
                            </div>
                            @endif
                            <div class="col-12">
                                <button class="register-button mt-0">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Login Content Area End Here -->