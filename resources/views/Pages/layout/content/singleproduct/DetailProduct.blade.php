<!-- Begin Product Area -->
<div class="product-area pt-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}<br>
                    </div>
                    @endif
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Mô tả</span></a></li>
                        <li><a data-toggle="tab" href="#product-details"><span>Thông tin sản phẩm</span></a></li>
                        <li><a data-toggle="tab" href="#reviews"><span>Đánh giá</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                    <span>{{$product->content}}</span>
                </div>
            </div>
            <div id="product-details" class="tab-pane" role="tabpanel">
                <div class="product-details-manufacturer">
                    <div class="choose-group-product">
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: center">
                                            <h3>Thông số kỹ thuật</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Tên:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->name}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>CPU:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->cpu}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Ram:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->ram}} GB</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Bộ nhớ trong:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->memory}} GB</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Kích thước màn hình:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->screen_size}} inches</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Độ phân giải:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->resolution}} pixel</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Hệ điều hành:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->os}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Phiên bản:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->os_version}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Camera trước:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->front_camera}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Camera sau:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->back_camera}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Bluetooth:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->bluetooth}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <label>Pin:</label>
                                            </div>
                                        </td>
                                        <td class="pro-title">
                                            <h6>{{$product->info_products->battery}} mAh</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reviews" class="tab-pane" role="tabpanel">
                <div class="product-reviews">
                    <div class="product-details-comment-block">
                        <div class="comment-review">
                            <span>Nhận xét </span>
                            <ul class="rating">
                                @for($i=0;$i< 5;$i++) @if($i<$product->rate)
                                    <li><i class="fa fa-star-o"></i></li>
                                    @else
                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                    </li>
                                    @endif
                                    @endfor
                            </ul>
                        </div>
                        <div class="review-btn">
                            <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">VIẾT ĐÁNH
                                GIÁ</a>
                        </div>
                        <!-- Begin Quick View | Modal Area -->
                        <div class="modal fade modal-wrapper" id="mymodal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h3 class="review-page-title">Viết đánh giá của bạn</h3>
                                        <div class="modal-inner-area row">
                                            <div class="col-lg-6">
                                                <div class="li-review-product">
                                                    <img src="{{$product->image}}" alt="Li's Product" height="200"
                                                        width="200">
                                                    <div class="li-review-product-desc">
                                                        <h6 class="li-product-name" style="font-size: 24px">
                                                            {{$product->name}}</h6>
                                                        <p>
                                                            <span>{{$product->content}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="li-review-content">
                                                    <!-- Begin Feedback Area -->
                                                    <div class="feedback-area">
                                                        <div class="feedback">

                                                            <h3 class="feedback-title">Đánh giá sản phẩm</h3>
                                                            <form action="" method="post">
                                                                @csrf
                                                                <p class="your-opinion">
                                                                    <label>Đánh giá</label>
                                                                    <span>
                                                                        <select name="rate" class="star-rating">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </span>
                                                                </p>
                                                                <p class="feedback-form">
                                                                    <label for="feedback">Góp ý của bạn</label>
                                                                    <textarea id="feedback" name="comment" cols="45"
                                                                        rows="8" aria-required="true"></textarea>
                                                                </p>
                                                                <div class="feedback-input">
                                                                    <!-- <p class="feedback-form-author">
                                                                        <label for="author">Name<span
                                                                                class="required">*</span>
                                                                        </label>
                                                                        <input id="author" name="author" value=""
                                                                            size="30" aria-required="true" type="text">
                                                                    </p>
                                                                    <p class="feedback-form-author feedback-form-email">
                                                                        <label for="email">Email<span
                                                                                class="required">*</span>
                                                                        </label>
                                                                        <input id="email" name="email" value=""
                                                                            size="30" aria-required="true" type="text">
                                                                        <span class="required"><sub>*</sub> Required
                                                                            fields</span>
                                                                    </p> -->
                                                                    <div class="feedback-btn pb-15">
                                                                        <button class="close btn btn-success"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">Thoát</button>
                                                                        <button type="submit" class="btn btn-warning"
                                                                            id="mc-submit">
                                                                            Xác nhận
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Feedback Area End Here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick View | Modal Area End Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->