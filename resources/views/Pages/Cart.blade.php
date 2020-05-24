@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Giỏ hàng'])
@include('Pages.layout.content.cart.CartTable')
@endsection