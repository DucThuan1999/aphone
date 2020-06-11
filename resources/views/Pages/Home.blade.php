@extends('Pages.layout.MainLayout')

@section('content')

@include('Pages.layout.content.home.SliderWithCategory',['products'=>$products,'categories'=>$categories,'suppliers'=>$suppliers])

@include('Pages.layout.content.home.StaticBanner')

{{-- @include('Pages.layout.content.home.HotDealsProducts') --}}

@include('Pages.layout.content.home.PromoteProducts',['productsPromotion'=>$productsPromotion])

@include('Pages.layout.content.ProductArea',['products'=>$randomProductsArea,'categories'=>$categories,'title'=>"Gợi
ý sản phẩm"])

@include('Pages.layout.content.home.StaticBannerBottom',['twoPromotions'=>$twoPromotions])

@include('Pages.layout.content.ProductArea',['products'=>$randomProductsArea,'categories'=>$categories,'title'=>"Sản
phẩm được quan tâm"])

{{-- @include('Pages.layout.content.home.TrendingProducs') --}}

@endsection