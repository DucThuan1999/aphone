@component('mail::message')
# Email xác nhận đơn hàng

{{$user->firstname}} {{$user->lastname}} thân mến.<br>Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ vận chuyển đơn
hàng của bạn ngay khi nhận được tiền cọc.

Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br>
{{ config('app.name') }}
@endcomponent