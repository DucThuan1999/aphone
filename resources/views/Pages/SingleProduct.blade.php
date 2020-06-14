@extends('Pages.layout.MainLayout')

@section('content')

@include('Pages.layout.content.Breadcrumb',['secondPath'=>$product->name])

@include('Pages.layout.content.singleproduct.ContentProduct',['product' => $product, 'encloseProducts' =>
$encloseProducts, 'images' => $images])

@include('Pages.layout.content.singleproduct.DetailProduct',['comments'=>$comments])

@include('Pages.layout.content.ProductArea',['products'=>$encloseProducts,'categories'=>$categories,'title'=>"Sản
phẩm tương tự"])


@endsection