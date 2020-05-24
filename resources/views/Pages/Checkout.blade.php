@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Thanh toán'])
@include('Pages.layout.content.checkout.CheckoutForm')
@endsection