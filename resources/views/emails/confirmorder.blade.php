@component('mail::message')
# Email xác nhận đơn hàng

{{$user->firstname}} {{$user->lastname}} thân mến.<br>Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ tiến hành vận
chuyển đơn hàng của bạn sớm nhất.
@component('mail::table')
| Tên sản phẩm | Số lượng | Giá bán |
| ------------- |:-------------:| --------:|
@foreach ($cart as $itemCart)
|{{$itemCart->name}}|{{$itemCart->qty}}|{{number_format($itemCart->subtotal)}} đ
@endforeach
@endcomponent

Tổng cộng thành tiền: {{Cart::instance($user)->total()}} đ<br>
Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br>
{{ config('app.name') }}
@endcomponent