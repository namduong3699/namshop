@extends('main')
@section('page')
Bài viết
@endsection
<!-- Header -->
@section('header')
@include('modules/header_all')
@endsection
<!-- Cart -->
@section('cart')
@include('modules/cart')
@endsection
<!-- Title page -->
@section('title')
@include('modules/title_blog')
@endsection
<!-- Content page -->
@section('content')
@include('modules/content_blog')
@endsection
<!-- Footer -->
@section('footer')
@include('modules/footer')
@endsection
<!-- Back to top -->
@section('back')
@include('modules/backtotop')
@endsection