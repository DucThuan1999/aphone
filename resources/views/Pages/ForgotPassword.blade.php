@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Quên mật khẩu'])
@include('Pages.layout.content.user.ForgotPasswordForm')
@endsection