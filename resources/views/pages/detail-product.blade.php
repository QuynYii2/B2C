@extends('master')

@section('title', 'Kết quả tìm kiếm')

@section('content')
    <style>
        .active-item {
            background-color: red;
        }

        .active-item a span {
            color: white;
        }

    </style>
    <div class="container mt-5">
        @php $props = []; @endphp
        @foreach($data['item']['props_list'] as $key => $value)
            @php
                $colonPosition = strpos($key, ":");
                $group = substr($key, 0, $colonPosition);
                $props[$group][$key] = $value;
            @endphp
        @endforeach
        <div id="product_name">{{ $data['item']['title'] }}</div>
        <img src="{{ $data['item']['pic_url'] }}" alt="" id="thumb_product">
        <div id="product_url" hidden>{{ $data['item']['detail_url'] }}</div>
        <div class="price">Giá bán: <b>{{ $data['item']['price'] }}</b></div>
        <input type="number" id="myNumber" value="0" min="0" max="100" step="1">
        <button onclick="increaseNumber()">Tăng</button>
        <button onclick="decreaseNumber()">Giảm</button>

        <ul id="sizeList"  data-property="尺码" class="J_TSaleProp tb-clearfix" style="display: flex;">
            <div><b>Size</b></div>
            @foreach($props['20509'] as $valueSize => $labelSize)
                <li data-value="size {{ substr($labelSize,5,1) }}" class="" style="list-style: none; padding: 5px 10px; border: 1px solid gray; cursor: pointer;">
                    <a><span>{{ substr($labelSize,5,1) }}</span></a>
                </li>
            @endforeach
        </ul>

        <ul id="colorList"  data-property="尺码" class="J_TSaleProp tb-clearfix" style="display: flex;">
            <div><b>Color</b></div>
            @foreach($props['1627207'] as $valueColor => $labelColor)
                @php
                    $parts = explode(":", $labelColor);
                    $color = $parts[1];
                @endphp
                <li data-value="{{$color}}" class="" style="list-style: none; padding: 5px 10px; border: 1px solid gray; cursor: pointer; background: {{$color}}"></li>
            @endforeach
        </ul>

        <button class="add-to-cart" data-product-id="{{ $data['item']['num_iid'] }}">Thêm vào giỏ hàng</button>


        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $data['item']['title'] }}</h5>
                <img src="{{ $data['item']['pic_url'] }}" class="card-img-top" alt="Product Image">
                <p class="card-text">Price: {{ $data['item']['price'] }}</p>
                <p class="card-text">Seller: {{ $data['item']['seller_info']['nick'] }}</p>
                <p class="card-text">Sales: {{ $data['item']['sales'] }}</p>
                <p class="card-text">Description: {!! $data['item']['desc'] !!}</p>

                <div class="row">
                    <div class="col">
                        <h6>Product Images:</h6>
                        @foreach ($data['item']['item_imgs'] as $image)
                            <img src="{{ $image['url'] }}" class="img-thumbnail" alt="Product Image">
                        @endforeach
                    </div>
                    <div class="col">
                        <h6>Property Images:</h6>
                        @foreach ($data['item']['prop_imgs']['prop_img'] as $propImg)
                            <img src="{{ $propImg['url'] }}" class="img-thumbnail" alt="Property Image">
                        @endforeach
                    </div>
                </div>

                <h6>SKU Information:</h6>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Price</th>
                        <th>Original Price</th>
                        <th>Properties</th>
                        <th>Quantity</th>
                        <th>Sku ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data['item']['skus']['sku'] as $sku)
                        <tr>
                            <td>{{ $sku['price'] }}</td>
                            <td>{{ $sku['orginal_price'] }}</td>
                            <td>{{ $sku['properties_name'] }}</td>
                            <td>{{ $sku['quantity'] }}</td>
                            <td>{{ $sku['sku_id'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div  id="add_cart_success" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thành công</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Thêm sản phẩm vào giỏ hàng thành công.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"><a href="/search_product">Tiếp tục mua hàng</a></button>
                    <button type="button" class="btn btn-secondary" ><a href="/cart">Xem giỏ hàng</a></button>
                </div>
            </div>
        </div>
    </div>
@endsection



