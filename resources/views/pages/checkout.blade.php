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
                    <div class="col text-right" id="price_total">TOTAL PRICE: <b
                            id="total-price-value">{{ $cartItem->sum('total_price') }}</b></div>
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
                        <label for="mail">Số điện thoại:</label>
                        <input type="text" name="mail" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Phương thức thanh toán:</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="paypal">PayPal</option>
                            <option value="credit_card">Credit Card</option>
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
    <script>
        function getAllTotal() {
            let totalPrice = document.getElementById('total-price-value').innerText;
            let totalCheckout = document.getElementById('total-checkout');
            totalCheckout.value = parseFloat(totalPrice);
        }

        getAllTotal();

        // $(document).ready(function () {
        //         $('#checkoutForm').attr('action', 'http://127.0.0.1:8000/checkout-paypal');
        //     }
        // )
    </script>
@endsection
