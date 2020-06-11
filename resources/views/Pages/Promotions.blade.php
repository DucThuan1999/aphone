@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Khuyến mãi'])
@include('Pages.layout.content.promotions.ListPromotions')
@endsection