@extends('Pages.layout.MainLayout')

@section('content')
@include('Pages.layout.content.Breadcrumb',['secondPath'=>'Liên hệ'])
<div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
    @include('Pages.layout.content.contact.StoreLocation')
    @include('Pages.layout.content.contact.Feedback')
</div>
@endsection