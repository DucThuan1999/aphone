<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30" style="margin: auto">
                <!-- Login Form s-->
                <form style="margin-top: 4em" action="/forgotpassword/change" method="POST">
                    <div class="login-form">
                        <h4 class="login-title">Quên mật khẩu</h4>
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20" style="display:none">
                                <input class="mb-0" name="email" type="hidden" id="input-email">
                            </div>
                            <div class="col-md-12 col-12 mb-20">
                                <label>Mật khẩu hiện tại:</label>
                                <input class="mb-0" name="password_old" type="password"
                                    placeholder="Nhập mật khẩu hiện tại">
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Mật khẩu mới:</label>
                                <input class="mb-0" name="password_new" type="password"
                                    placeholder="Nhập mật khẩu mới">
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Xác nhận lại mật khẩu:</label>
                                <input class="mb-0" name="password_new_confirm" type="password"
                                    placeholder="Xác nhận mật khẩu">
                            </div>

                            @if(count($errors)>0)
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    {{$errors->first()}}
                                </div>
                            </div>
                            @endif

                            @if(session('loginAlert'))
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    {{session('loginAlert')}}
                                </div>
                            </div>
                            @endif
                            @if(session('loginAlertSuccess'))
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    {{session('loginAlertSuccess')}}
                                </div>
                            </div>
                            @endif
                            <div class="col-md-8">
                                <button class="register-button mt-0">Thay đổi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Login Content Area End Here -->