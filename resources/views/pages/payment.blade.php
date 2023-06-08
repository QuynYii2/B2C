@extends('master')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')
    <div class="container">
        <h1>Trang thanh toán</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>Thông tin đơn hàng</h2>
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
                            <td>{{ $cartItem->product_name }}</td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>{{ $cartItem->ttotal_price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Thông tin thanh toán</h2>
                <form action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Phương thức thanh toán</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                            <option value="credit_card">Thẻ tín dụng</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thanh toán</button>
                </form>
            </div>
        </div>
    </div>
@endsection
