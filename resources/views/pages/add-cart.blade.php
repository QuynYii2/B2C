@extends('master')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')
    <form action="{{ route('cart.addToCart') }}" method="POST">
        @csrf
        <!-- Các trường thông tin sản phẩm -->
        <input type="hidden" name="product_name" value="{{ $product->name }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="product_url" value="{{ $product->url }}">
        <input type="hidden" name="attribute" value="{{ $product->attribute }}">
        <input type="hidden" name="product_image" value="{{ $product->image }}">
        <input type="hidden" name="product_price" value="{{ $product->price }}">

        <!-- Nút thêm vào giỏ hàng -->
        <button type="submit">Thêm vào giỏ hàng</button>
    </form>
@endsection
