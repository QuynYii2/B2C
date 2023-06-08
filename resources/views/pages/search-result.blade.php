@extends('master')

@section('title', 'Kết quả tìm kiếm')

@section('styles')
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            max-width: 100%;
            height: auto;
        }

        .product-card .card-title {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product-card .card-text {
            color: #777;
        }

        .product-card .btn {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .product-card .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2>Kết quả tìm kiếm sản phẩm: {{$nameProduct}}</h2>

        @if(isset($data['items']) && count($data['items']['item']) > 0)
            <div class="row">
                @foreach($data['items']['item'] as $item)
                    <div class="col-md-3">
                        <div class="card product-card">
                            <img src="{{ $item['pic_url'] }}" class="card-img-top" alt="Hình ảnh">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['title'] }}</h5>
                                <p class="card-text">Giá: {{ $item['price'] }}</p>
                                <p class="card-text">Số lượng bán: {{ $item['sales'] }}</p>
                                <a href="{{ route('product.detail', ['id' => $item['num_iid']]) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Không có kết quả tìm kiếm.</p>
        @endif
    </div>
@endsection

