<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30" style="margin: auto">
                <!-- Login Form s-->
                <form style="margin-top: 4em" action="/login" method="POST">
                    <div class="login-form">
                        <h4 class="login-title">Đăng nhập</h4>
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Email</label>
                                <input class="mb-0" name="email" type="text"
                                    placeholder="Nhập email hoặc số điện thoại">
                            </div>
                            <div class="col-12 mb-20">
                                <label>Mật khẩu</label>
                                <input class="mb-0" name="password" type="password"
                                    placeholder="Mật khẩu từ 6 đến 32 ký tự">
                            </div>
                            {{-- <div class="col-md-8">
                                <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                    <input type="checkbox" id="remember_me">
                                    <label for="remember_me">Remember me</label>
                                </div> 
                            </div> --}}

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
                                <button class="register-button mt-0">Đăng nhập</button>
                            </div>
                            <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                <a href="#"> Quên mật khẩu?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <form action="#">
                    <div class="login-form">
                        <h4 class="login-title">Register</h4>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-20">
                                <label>First Name</label>
                                <input class="mb-0" type="text" placeholder="First Name">
                            </div>
                            <div class="col-md-6 col-12 mb-20">
                                <label>Last Name</label>
                                <input class="mb-0" type="text" placeholder="Last Name">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Email Address*</label>
                                <input class="mb-0" type="email" placeholder="Email Address">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Password</label>
                                <input class="mb-0" type="password" placeholder="Password">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Confirm Password</label>
                                <input class="mb-0" type="password" placeholder="Confirm Password">
                            </div>
                            <div class="col-12">
                                <button class="register-button mt-0">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> --}}
        </div>
    </div>
</div>
<!-- Login Content Area End Here -->