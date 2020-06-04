@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Tài khoản của tôi'])
@include('Pages.layout.content.user.InfoUserForm',['user' => $user, 'location' => $location])
@endsection