<!--Wishlist Area Strat-->
<div class="wishlist-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-product-name">Mã đơn</th>
                                    <th class="li-product-remove">Ngày đặt</th>
                                    <th class="li-product-thumbnail">Ngày giao</th>
                                    <th class="li-product-price">Tổng tiền</th>
                                    <th class="li-product-price">Thành tiền</th>
                                    <th class="li-product-stock-status">Trạng thái</th>
                                    <th class="li-product-stock-status">Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $bill)
                                <tr>
                                    <td class="li-product-remove"><a href="#">{{$bill->id}}</a></td>
                                    <td class="li-product-name"><a href="#">
                                            @php
                                            $date = date_create($bill->created_at);
                                            echo date_format($date, 'd-m-Y');
                                            @endphp
                                        </a></td>
                                    <td class="li-product-name"><a href="#">
                                            @if($bill->updated_at != $bill->created_at)
                                            @php
                                            $date = date_create($bill->updated_at);
                                            echo date_format($date, 'd-m-Y');
                                            @endphp
                                            @endif
                                        </a></td>
                                    <td class="li-product-price"><span class="amount">{{number_format($bill->total)}}
                                            đ</span></td>
                                    <td class="li-product-price"><span
                                            class="amount">{{number_format($bill->total - $bill->total_discount)}}
                                            đ</span></td>
                                    <td class="li-product-stock-status">
                                        @switch($bill->status)
                                        @case(0)
                                        <span class="text-secondary">Đang xử lý</span>
                                        @break
                                        @case(1)
                                        <span class="text-warning">Đang giao</span>
                                        @break
                                        @case(2)
                                        <span class="text-success">Đã giao</span>
                                        @break
                                        @case(3)
                                        <span class="text-danger">Huỷ</span>
                                        @break
                                        @default
                                        Không xác định
                                        @endswitch
                                    </td>
                                    <td class="li-product-add-cart"><a href="/order/{{$bill->id}}">xem chi tiết</a></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Wishlist Area End-->