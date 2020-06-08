<?php
    if(Auth::check()){
        $cart = Cart::instance(Auth::user())->content();
    }else{
        $cart = Cart::content();
    }    
?>
<!--Checkout Area Strat-->
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <form action="checkout/bills/add" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="checkbox-form">
                        <h3>Thông tin khách hàng</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Email:<span class="required">*</span></label>
                                    <input readonly disabled value="{{$user->email}}" type="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Họ:<span class="required">*</span></label>
                                    <input readonly disabled value="{{$user->firstname}}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Tên: <span class="required">*</span></label>
                                    <input readonly disabled value="{{$user->lastname}}" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Số điện thoại:<span class="required">*</span></label>
                                    <input disabled value="{{$user->phone}}" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Địa chỉ nhận hàng: <span class="required">*</span></label>
                                    <ul>
                                        @foreach ($addresses as $address)
                                        <li class="mt-15">
                                            <input onclick="handleAddressRadio()" class="radio-custom" name="address"
                                                value="{{$address->id}}" type="radio">
                                            <h5 class="text-initial">{{$address->street}},
                                                {{$address->ward->first()->_name}},
                                                {{$address->district->first()->_name}},
                                                {{$address->province->first()->_name}}</h5>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <label>Giao đến địa chỉ khác</label>
                                    <input onclick="handleCheckShipAnother()" name="another_address" id="ship-box"
                                        type="checkbox">
                                </h3>
                            </div>
                            <div id="ship-box-info" class="row">
                                <div class="col-md-12 row">
                                    <div class="col-6">
                                        <div class="country-select clearfix">
                                            <label>Tỉnh/Thành phố <span class="required">*</span></label>
                                            <select onchange="changeAnotherProvince()" id="select_another_province"
                                                name="another_province" class=" wide">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="country-select clearfix">
                                            <label>Quận huyện<span class="required">*</span></label>
                                            <select onchange="changeAnotherDistrict()" id="select_another_district"
                                                name="another_district" class="nice-select wide">
                                                <option disabled selected>Quận huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="country-select clearfix">
                                            <label>Phường xã<span class="required">*</span></label>
                                            <select id="select_another_ward" name="another_ward"
                                                class="nice-select wide">
                                                <option disabled selected>Phường xã</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="checkout-form-list">
                                            <label>Đường:<span class="required">*</span></label>
                                            <input id="another_street" name="another_street" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Ghi chú:</label>
                                    <textarea name="note" id="checkout-mess" cols="30" rows="10"
                                        placeholder="Những lưu ý về đơn hàng của bạn."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Thông tin đơn hàng:</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Sản phẩm</th>
                                        <th class="cart-product-total">Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $itemCart)
                                    <tr class="cart_item">
                                        <td class="cart-product-name">{{$itemCart->name}}<strong
                                                class="product-quantity">
                                                × {{$itemCart->qty}}</strong></td>
                                        <td class="cart-product-total"><span class="amount">{{$itemCart->total(0)}}
                                                đ</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Tổng tiền</th>
                                        <td><span class="amount">{{Cart::priceTotal(0)}} đ</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Khuyến mãi</th>
                                        <td><span class="amount">{{Cart::discount(0)}} đ</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Thành tiền</th>
                                        <td><strong><span class="amount">{{Cart::total(0)}} đ</span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="#payment-1">
                                            <h5 class="panel-title">
                                                <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    Hình thức thanh toán
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="mb-15">
                                                    <li>
                                                        <input onchange="handlePaymentMethod()" checked
                                                            class="radio-custom" type="radio" name="method_payment"
                                                            value="0">
                                                        <p class="text-initial">Thanh toán khi nhận hàng</p>
                                                    </li>
                                                    <li>
                                                        <input onchange="handlePaymentMethod()" id="payment-radio"
                                                            class="radio-custom" type="radio" name="method_payment"
                                                            value="1">
                                                        <p class="text-initial">Thanh toán qua thẻ tín dụng</p>
                                                    </li>
                                                </ul>
                                                <div class="hide" id="paypal-button-container"></div>
                                                <div class="hide" id="paypal-button-script"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="#payment-2">
                                            <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Mã giảm giá
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="checkout-form-list">
                                                    <div class="row">
                                                        <div class="col-9"><input class="wide" type="text">
                                                        </div>
                                                        <div class="col-3"><button type="button"
                                                                class="btn btn-primary">Áp
                                                                dụng</button></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="card">
                                        <div class="card-header" id="#payment-2">
                                            <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    PayPal
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="order-button-payment">
                                    <input value="Đặt hàng" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Checkout Area End-->