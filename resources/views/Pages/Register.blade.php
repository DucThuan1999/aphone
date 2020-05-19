@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Đăng ký'])
@include('Pages.layout.content.register.RegisterForm')
@endsection