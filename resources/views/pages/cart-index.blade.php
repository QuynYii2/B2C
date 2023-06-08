@extends('master')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')
    <style>
        .total {
            display: block;
        }
        .title{
            margin-bottom: 5vh;
        }
        .card{
            margin: auto;
            max-width: 100%;
            width: 100%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent;
        }
        @media(max-width:767px){
            .card{
                margin: 3vh auto;
            }
        }
        .cart{
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }
        @media(max-width:767px){
            .cart{
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem;
            }
        }
        .summary{
            background-color: #ddd;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: rgb(65, 65, 65);
        }
        @media(max-width:767px){
            .summary{
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem;
            }
        }
        .summary .col-2{
            padding: 0;
        }
        .summary .col-10
        {
            padding: 0;
        }.row{
             margin: 0;
         }
        .title b{
            font-size: 1.5rem;
        }
        .main{
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }
        .col-2, .col{
            padding: 0 1vh;
        }
        a{
            padding: 0 1vh;
        }
        .close{
            margin-left: auto;
            font-size: 0.7rem;
        }
        img{
            width: 3.5rem;
        }
        .back-to-shop{
            position: absolute;
            bottom: 5%;
        }
        h5{
            margin-top: 4vh;
        }
        hr{
            margin-top: 1.25rem;
        }
        form{
            padding: 2vh 0;
        }
        select{
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }
        input{
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }
        input:focus::-webkit-input-placeholder
        {
            color:transparent;
        }
        .btn{
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }
        .btn:focus{
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            -webkit-user-select: none;
            transition: none;
        }
        .btn:hover{
            color: white;
        }
        a{
            color: black;
        }
        a:hover{
            color: black;
            text-decoration: none;
        }
        #code{
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
        }
    </style>
    <div class="card">
        <div class="row">
            <div class="col-md-12 cart">
                <div class="title">
                    <div class="row">
                        <div class="col-md-6"><h4><b>Cart</b></h4></div>
                        <div class="col-md-6 align-self-center text-right text-muted">
                            <a href="#" onclick="deleteAllCartItems()">Delete All</a>
                        </div>
                    </div>
                </div>
                @foreach($listCart as $cart)
                    <div class="row border-top border-bottom" data-item-id="{{ $cart->id }}">
                        <div class="col-md-3">
                            <img class="img-fluid" src="{{ $cart->image}}">
                            <div class="row">{{ $cart->product_name}}</div>
                        </div>
                        <div class="col-md-3">
                            @if(is_string($cart->attribute))
                                @php
                                    $attributeData = json_decode($cart->attribute, true);
                                @endphp
                                <p>Size: {{ $attributeData['size'] }}</p>
                                <p>Color: {{ $attributeData['color'] }}</p>
                            @else
                                <p>Size: {{ $cart->attribute['size'] }}</p>
                                <p>Color: {{ $cart->attribute['color'] }}</p>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="decrease-number" data-item-id="{{ $cart->id }}">-</a>
                            <input type="number" id="myNumber" value="{{ $cart->quantity }}" min="0" max="100" step="1" data-item-id="{{ $cart->id }}">
                            <a href="#" class="increase-number" data-item-id="{{ $cart->id }}">+</a>

                        </div>
                        <div class="col-md-3" data-item-id="{{ $cart->id }}">
                            &euro; <span id="totalPrice{{ $cart->id }}">{{ $cart->total_price }}</span>
                            <a href="#" data-item-id="{{ $cart->id }}" onclick="deleteCartItem({{ $cart->id }})">Xóa</a>
                        </div>
                    </div>
                @endforeach

                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col-md-6 ">
                        <div class="back-to-shop"><a href="#">&leftarrow;</a><span class="text-muted">Buy more product</span></div>
                    </div>
                    <div class="col-md-6 total">
                        <div class="col">TOTAL PRICE</div>
                        <div class="col text-right" id="price_total">{{ $cart->sum('total_price') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('checkout.show') }}"  class="btn btn-primary">Thanh toán</a>
                    </div>
                </div>
            </div>
{{--            <div class="col-md-4 summary">--}}
{{--                <div><h5><b>Summary</b></h5></div>--}}
{{--                <hr>--}}
{{--                <div class="row">--}}
{{--                    <div class="col" style="padding-left:0;">ITEMS 3</div>--}}
{{--                    <div class="col text-right">&euro; 132.00</div>--}}
{{--                </div>--}}
{{--                <form>--}}
{{--                    <p>SHIPPING</p>--}}
{{--                    <select><option class="text-muted">Standard-Delivery - &euro;5.00</option></select>--}}
{{--                    <p>Payment methods</p>--}}
{{--                    <select><option class="text-muted">Standard-Delivery - &euro;5.00</option></select>--}}
{{--                </form>--}}
{{--                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">--}}
{{--                    <div class="col">TOTAL PRICE</div>--}}
{{--                    <div class="col text-right">&euro; 137.00</div>--}}
{{--                </div>--}}
{{--                <button class="btn">CHECKOUT</button>--}}
{{--            </div>--}}
        </div>

    </div>
@endsection

