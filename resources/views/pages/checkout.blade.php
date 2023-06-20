@php use App\Enums\DepositStatus;use App\Models\Deposit; @endphp
@extends('master')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')
    <div class="container-fuild">
        <div class="row">
            <div class="col-md-8">
                <h2>Thông tin đơn hàng</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td>
                                    <div class="item" style="display: flex; gap: 30px;">
                                        <img class="img-fluid" src="{{ $cartItem->image}}" width="50px">
                                        <div class="info_product">
                                            {{ $cartItem->product_name }}
                                            @if(is_string($cartItem->attribute))
                                                @php
                                                    $attributeData = json_decode($cartItem->attribute, true);
                                                @endphp
                                                <div class="attribute">
                                                    Size: {{ $attributeData['size'] }}<br>
                                                    Color: {{ $attributeData['color'] }}
                                                </div>
                                            @else
                                                <div class="attribute">
                                                    Size: {{ $cartItem->attribute['size'] }}<br>
                                                    Color: {{ $cartItem->attribute['color'] }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $cartItem->quantity }}</td>
                                <td>{{ $cartItem->total_price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="total">
                    <div class="col text-right" id="shipping_fee">
                        SHIPPING PRICE:
                        <b id="shipping_fee-value">1</b>
                    </div>
                    <div class="col text-right" id="tax_percent">
                        TAX PRICE:
                        {{--                        (--}}
                        {{--                        <b class="tax_percent">10</b>--}}
                        {{--                        %):--}}
                        <b class="tax_percent" id="tax_percent-value">1</b>
                    </div>
                    <div class="col text-right" id="product_total">
                        PRODUCT PRICE:
                        <b id="product-price-value">
                            {{ $cartItems->sum('total_price') }}
                        </b>
                    </div>
                    <div class="col text-right" id="price_total">
                        TOTAL PRICE:
                        <b id="total-price-value">
                            1
                        </b>
                    </div>
                    <div class="col text-right" id="price_percent">
                        PERCENT PRICE
                        {{--                        (--}}
                        {{--                        <b>10</b>--}}
                        {{--                        %):--}}
                        <b id="price_percent-value">
                            {{ $cartItems->sum('total_price') }}
                        </b>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Thông tin thanh toán</h2>
                <form id="" method="post" action="{{route('checkout.create')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ tên:</label>
                        <input type="text" name="full_name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                    </div>

                    <div class="form-group">
                        <label for="mail">Email:</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Phương thức thanh toán:</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="paypal">PayPal</option>
                            <option value="credit_card">Credit Card</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ware_house">Chọn kho hàng muốn giao đến:</label>
                        <select name="ware_house" onchange="getWareHouse();" id="ware_house" class="form-control">
                            @foreach($allWareHouse as $wareHouse)
                                <option title="{{$wareHouse->country}}"
                                        value="{{$wareHouse->id}}">{{$wareHouse->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="text" name="total-checkout" hidden id="total-checkout" value="1">

                    <button type="submit" class="btn btn-primary">Hoàn tất Thanh toán</button>
                </form>

                <!-- Modal hiển thị khi thanh toán thành công -->
                <div class="modal fade" id="checkoutSuccessModal" tabindex="-1" role="dialog"
                     aria-labelledby="checkoutSuccessModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="checkoutSuccessModalLabel">Thanh toán thành công</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được ghi nhận.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal hiển thị khi có lỗi trong quá trình thanh toán -->
                <div class="modal fade" id="checkoutErrorModal" tabindex="-1" role="dialog"
                     aria-labelledby="checkoutErrorModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="checkoutErrorModalLabel">Lỗi thanh toán</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại sau.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('/assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
    <script>
        function getWareHouse() {
            var ware_house = document.getElementById("ware_house");
            var value = ware_house.value;
            var title = ware_house.options[ware_house.selectedIndex].title;
            var text = ware_house.options[ware_house.selectedIndex].text;
            console.log(value, text, title)

            // function getAllTotal() {
            //     let totalPrice = document.getElementById('total-price-value').innerText;
            //     let totalCheckout = document.getElementById('total-checkout');
            //     totalCheckout.value = parseFloat(totalPrice);
            //     console.log(totalPrice)
            // }

            function updatePrice() {
                console.log('aa')
                $.ajax({
                    url: '/api/deposit/list',
                    method: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        for (i = 0; i < response.length; i++) {
                            if (title == response[i]['address_to'] && response[i]['address_from'] == 'cn') {
                                let pricePercent = response[i]['price_percent'];
                                let shippingFee = response[i]['shipping_fee'];
                                let taxPercent = response[i]['tax_percent'];

                                let productPrice = document.getElementById('product-price-value').innerText;
                                productPrice = parseFloat(productPrice);

                                let shippingPrice = document.getElementById('shipping_fee-value');
                                shippingPrice.innerText = shippingFee;

                                let taxPrice = document.getElementById('tax_percent-value');
                                taxPrice.innerText = ((taxPercent * productPrice) / 100).toFixed(2);

                                let totalPrice = document.getElementById('total-price-value');
                                totalPrice.innerText = (parseFloat(productPrice) + parseFloat(taxPrice.innerText) + parseFloat(shippingPrice.innerText)).toFixed(2);

                                let price_percent = document.getElementById('price_percent-value');
                                price_percent.innerText = ((parseFloat(totalPrice.innerText) * pricePercent) / 100).toFixed(2);

                                let totalCheckout = document.getElementById('total-checkout');
                                totalCheckout.value = parseFloat(price_percent.innerText);
                            }
                        }
                    },
                    error: function (xhr) {
                    }
                });
            }

            updatePrice();

            // getAllTotal();
        }


        getWareHouse();
    </script>
@endsection
