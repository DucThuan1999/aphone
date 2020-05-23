@component('mail::message')
# Email đổi mật khẩu tài khoản của bạn

{{$user->firstname}} {{$user->lastname}} thân mến.<br>Để đổi mật khẩu tài khoản của bạn. Bạn
vui lòng nhấn vào nút bên dưới.

@component('mail::button', ['url' =>
'http://127.0.0.1:8000/forgotpassword/change?email='.$user->email])
Đổi mật khẩu
@endcomponent

Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br>
{{ config('app.name') }}
@endcomponent