@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Thông tin khuyến mãi'])
@include('Pages.layout.content.promotions.SinglePromotionContent',['promotion'=>$promotion,'productsPromotion'=>$productsPromotion])
@endsection