<br>
<div class="container mb-30">
    <div class="row">
        <!-- Begin Li's Blog Sidebar Area -->
        <div class="col-lg-3" style="border: 1px solid rgba(0,0,0,.125)">
            <div class="li-blog-sidebar-wrapper">
                <div class="li-blog-sidebar pt-25">
                    <h4 class="li-blog-sidebar-title">Tài khoản của {{$user->firstname}} {{$user->lastname}}</h4>
                    <ul class="li-blog-archive">
                        <li><a href="#">Thông tin tài khoản</a></li>
                        <li><a href="#">Giỏ hàng của tôi</a></li>
                        <li><a href="#">Sản phẩm yêu thích</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Li's Blog Sidebar Area End Here -->
        <div class="col-lg-9">
            <div class="card z-depth-3">
                <div class="card-body">
                    <ul class="nav nav-pills nav-pills-primary nav-justified">
                        <li class="nav-item">
                            <a href="#" class="nav-link"><i class="icon-note"></i>
                                <h2>Thông tin tài khoản</h2>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane active show" id="edit">
                            <form method="POST" action="/infouser/changepassword">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label form-control-label">Họ</label>
                                    <div class="col-lg-7">
                                        <input name="firstname" class="form-control" type="text"
                                            value="{{$user->firstname}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label form-control-label">Tên</label>
                                    <div class="col-lg-7">
                                        <input name="lastname" class="form-control" type="text"
                                            value="{{$user->lastname}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-7">
                                        <input name="email" class="form-control" readonly="true" type="email"
                                            value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label form-control-label">Điện thoại</label>
                                    <div class="col-lg-7">
                                        <input name="phone" class="form-control" readonly="true" type="number"
                                            value="{{$user->phone}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label form-control-label">Địa chỉ</label>
                                    <div class="col-lg-7">
                                        <input name="address" class="form-control" type="text"
                                            value="{{$user->address}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label form-control-label"></label>
                                    <div class="col-lg-7">
                                        <input name="checkbox_changepassword" id="changepassword-checkbox"
                                            style="height: 15px;width:15px" type="checkbox">
                                        <label for="changepassword-checkbox">Thay đổi mật khẩu</label>
                                    </div>
                                </div>
                                <div class="form-group row changepassword-input hide-changepassword">
                                    <label class="col-lg-2 col-form-label form-control-label">Mật khẩu hiện
                                        tại</label>
                                    <div class="col-lg-7">
                                        <input name="password_old" class="form-control" type="password"
                                            placeholder="Nhập mật khẩu hiện tại">
                                    </div>
                                </div>
                                <div class="form-group row changepassword-input hide-changepassword">
                                    <label class="col-lg-2 col-form-label form-control-label">Mật khẩu
                                        mới</label>
                                    <div class="col-lg-7">
                                        <input name="password_new" class="form-control" type="password"
                                            placeholder="Mật khẩu từ 6 đến 32 ký tự">
                                    </div>
                                </div>
                                <div class="form-group row changepassword-input hide-changepassword ">
                                    <label class="col-lg-2 col-form-label form-control-label">Nhập lại </label>
                                    <div class="col-lg-7">
                                        <input name="password_new_confirm" class="form-control" type="password"
                                            placeholder="Nhập lại mật khẩu mới">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label form-control-label"></label>
                                    <div class="col-lg-7">
                                        @if(count($errors)>0)
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                {{$errors->first()}}
                                            </div>
                                        </div>
                                        @endif

                                        @if(session('changeAlert'))
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                {{session('changeAlert')}}
                                            </div>
                                        </div>
                                        @endif
                                        @if(session('changeAlertSuccess'))
                                        <div class="col-md-12">
                                            <div class="alert alert-success">
                                                {{session('changeAlertSuccess')}}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label form-control-label"></label>
                                    <div class="col-lg-7">
                                        {{-- <div class="col-lg-3">
                                            <input type="reset" class="btn btn-secondary" value="Cancel">
                                        </div> --}}
                                        <div class="col-lg-4">
                                            <input type="submit" style="background-color: #293A6C"
                                                class="btn btn-primary" value="Cập nhật">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $('#changepassword-checkbox').change(function(){
        $('.changepassword-input').toggleClass('hide-changepassword');
    });
</script>
@endsection