@extends('Pages.layout.MainLayout')

@section('content')

@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Sản phẩm'])

@include('Pages.layout.content.products.ListProducts',['productsPagination'=>$productsPagination,'resultProducts'=>$resultProducts])

@endsection