@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Đổi mật khẩu'])
@include('Pages.layout.content.user.ChangePasswordForgotForm')
@endsection