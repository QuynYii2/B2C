@extends('master')

@section('title', 'Kết quả tìm kiếm')

<style>
    .product-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

        display: flex;
        flex-direction: column;
        height: 100%;
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

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
        height: 100%;
    }

    .card-title {
        height: 60px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .custom-img {
        max-height: 210px;
        object-fit: cover;
    }

</style>

@section('content')
    <div class="container-fluid">
        <h2>Kết quả tìm kiếm sản phẩm: {{$nameProduct}}</h2>

    @if(isset($data['items']) && count($data['items']['item']) > 0)
            <div class="row">
                @foreach($data['items']['item'] as $item)
                    <div class="col-md-3 col-6 col-sm-4 col-xl-2 mt-4">
                        <a href="{{ route('product.detail', ['id' => $item['num_iid'],  'service' => $services]) }}">
                            <div class="card product-card">
                                <img src="{{ $item['pic_url'] }}" class="card-img-top custom-img" alt="Hình ảnh">
                                <div class="card-body">
                                    <h5 class="card-title" >{{ $item['title'] }}</h5>
                                    <div>
                                    <p class="card-text">Giá: {{ number_format(convertCurrency('CNY', 'VND', 1), 0, ',', '.') }} VND - {{ $item['price'] }} ¥</p>
                                    <p class="card-text">Số lượng bán: {{ $item['sales'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p>Không có kết quả tìm kiếm.</p>
        @endif
    </div>
@endsection

