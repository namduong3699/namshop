@extends('main')
@section('page')
Liên hệ với chúng tôi
@endsection

<!-- Header -->
@section('header')
@include('modules/header_all')
@endsection
<!-- Cart -->
@section('cart')
@include('modules/cart')
@include('modules/wishlist')
@endsection
<!-- Title page -->
@section('title')
@include('modules/title_contact')
@endsection
<!-- Content page -->
@section('content')
@include('modules/content_contact')
@endsection
<!-- Map -->
@section('map')
@include('modules/map')
@endsection
<!-- Footer -->
@section('footer')
@include('modules/footer')
@endsection
<!-- Back to top -->
@section('back')
@include('modules/backtotop')
@endsection

@section('js')
@include('modules/js_contact')
@endsection

