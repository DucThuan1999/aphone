@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'So sánh sản phẩm'])
@include('Pages.layout.content.compare.CompareTable')
@endsection