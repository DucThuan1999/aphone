@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Sản phẩm yêu thích'])
@include('Pages.layout.content.wishlist.WishListTable',['wishlist'=>$wishlist])
@endsection