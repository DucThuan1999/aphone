@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Đơn hàng của tôi'])
@include('Pages.layout.content.order.SingleOrderTable',['bill'=>$bill])

@endsection