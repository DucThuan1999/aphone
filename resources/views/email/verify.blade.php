@component('mail::message')
# Xác nhận email tài khoản của bạn

{{$user->firstname}} {{$user->lastname}} thân mến.<br>Để đăng nhập vào tài khoản. Bạn
vui lòng xác nhận email của mình.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/verify?email='.$user->email.'&password='.$user->password])
Xác nhận email
@endcomponent

Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br>
{{ config('app.name') }}
@endcomponent