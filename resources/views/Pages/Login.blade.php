@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Đăng nhập'])
@include('Pages.layout.content.login.LoginForm')
@endsection