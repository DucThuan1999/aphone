@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Đăng ký'])
@include('Pages.layout.content.user.RegisterForm', ['provinces' => $provinces])
@endsection