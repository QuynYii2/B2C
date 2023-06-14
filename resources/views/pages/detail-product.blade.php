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

        #tabs-product.card {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5rem;
        }

        .card-title {
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media only screen and (max-width: 575px) {
            #tabs-product.card {
                display: block;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 1.5rem;
            }
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

        <div class="card tabs-product row" id="tabs-product">
            <div class="product-imgs col-sm-12 py-1 col-12" id="product">
                <div class="img-display ">
                    <div class="img-showcase d-flex flex-row bd-highlight">
                        @foreach ($data['item']['item_imgs'] as $key => $image)
                            @if ($key === 0)
                                <img id="thumb_product" class="img w-100 h-100 mt-2 img-focus" src="{{ $image['url'] }}"
                                     onclick="zoomImgModal(this)"
                                     alt="image" data-toggle="modal"
                                     data-target="#seeImageProduct">
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="img-select d-flex flex-row bd-highlight mb-2 mt-2 w-100">
                    @foreach ($data['item']['item_imgs'] as $image)
                        <div class="img-item">
                            <img class="img img-focus" onclick="zoomImg(this)"
                                 src="{{ $image['url'] }}"
                                 alt="shoe image">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="product-content col-md-12 py-1 col-12" style="z-index: 88;">
                @csrf
                <div id="product_name"><h2 class="product-title">{{ $data['item']['title'] }}</h2></div>
                <div id="product_url" hidden>{{ $data['item']['detail_url'] }}</div>
                <div class="product-rating">
                    <?php
                    $score_p = $data['item']['seller_info']['score_p'];
                    for ($i = 0; $i < $score_p; $i++) {
                        echo '<i class="fa fa-star"></i>';
                    }
                    if ($score_p % 1 !== 0) {
                        echo '<i class="fa fa-star-half-o"></i>';
                    }
                    ?>
                    <span><?php echo $score_p; ?></span>
                </div>
                <div class="product-price d-flex" style="gap: 3rem">
                    <p>Seller: <a
                            href="{{ $data['item']['seller_info']['zhuy'] }}"> {{ $data['item']['seller_info']['shop_name'] }}</a>
                    </p>
                    <p>Sales: {{ $data['item']['sales'] }}</p>
                    <p class="price">Price: <b>{{ $data['item']['price'] }}</b></p>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-4">
                        <label for="sizeList">{{ __('home.size') }}</label>
                        <select id="sizeList" name="sizeList"
                                class="form-control">
                            @foreach($props['20509'] as $valueSize => $labelSize)
                                <option value="size {{ substr($labelSize,5,1) }}"
                                        style="list-style: none; padding: 5px 10px; border: 1px solid gray; cursor: pointer;">
                                    {{ substr($labelSize,5,1) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 col-4">
                        <label for="colorList">{{ __('home.color') }}</label>
                        <select id="colorList" name="colorList"
                                class="form-control">
                            @foreach($props['1627207'] as $valueColor => $labelColor)
                                @php
                                    $parts = explode(":", $labelColor);
                                    $color = $parts[1];
                                @endphp
                                <option value="{{$color}}"
                                        style="list-style: none; padding: 5px 10px; border: 1px solid gray; cursor: pointer;">{{$color}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 col-4">
                        <label for="myNumber">{{ __('home.quantity') }}</label>
                        <input class="product-qty input form-control" type="number" name="myNumber" id="myNumber"
                               min="0"
                               value="1">
                    </div>
                </div>
                <div class="purchase-info d-flex mt-3">
                    <button type="button" class="btn-danger btn btn-16 add-to-cart"
                            data-product-id="{{ $data['item']['num_iid'] }}"><i
                            class="fa fa-shopping-cart"></i>
                        {{ __('home.buy now') }}
                    </button>
                </div>
            </div>
        </div>


        <div class="row bg-white py-3">
            <?php for ($i = 0;
                       $i < 12;
                       $i++) { ?>

            <div class="col-md-3 col-6 col-sm-4">
                <a href="">
                    <div class="card product-card">
                        @foreach ($data['item']['item_imgs'] as $key => $image)
                            @if ($key === 0)
                                <img src="{{ $image['url'] }}" class="card-img-top" alt="Hình ảnh">
                            @endif
                        @endforeach
                        <div class="card-body">
                            <h6 class="card-title">{{ $data['item']['title'] }}</h6>
                            <div>
                                <p class="card-text">Giá:</p>
                                <p class="card-text">Số lượng bán:</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>


    </div>



    <div id="add_cart_success" class="modal" tabindex="-1" role="dialog">
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
                    <a href="/search_product">
                        <button type="button" class="btn btn-primary">Tiếp tục mua hàng
                        </button>
                    </a>
                    <a href="/cart">
                        <button type="button" class="btn btn-secondary">Xem giỏ hàng</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>


        function zoomImgModal(x) {
            imgDf = document.getElementById('img-modal');
            imgDf.src = x.src;
        }

        function zoomImg(x) {
            imgDf = document.getElementById('img-default');
            imgDf.src = x.src;
        }

        {{--function addToCart() {--}}
        {{--    var productId = document.querySelector('.add-to-cart').getAttribute('data-product-id');--}}
        {{--    var price = document.querySelector('.price b').textContent;--}}
        {{--    var productName = document.querySelector('#product_name').textContent;--}}
        {{--    var productUrl = document.querySelector('#product_url').textContent;--}}
        {{--    var sizeList = document.getElementById('sizeList');--}}
        {{--    var colorList = document.getElementById('colorList');--}}


        {{--    var quantity = document.getElementById('myNumber').value;--}}

        {{--    var imageElement = document.getElementById('thumb_product');--}}
        {{--    var imageUrl = imageElement.src;--}}
        {{--    console.log(productId, price,productName, productUrl,sizeList, colorList, imageUrl);--}}

        {{--    --}}{{--$.ajax({--}}
        {{--    --}}{{--    url: '/cart/add',--}}
        {{--    --}}{{--    method: 'POST',--}}
        {{--    --}}{{--    data: {--}}
        {{--    --}}{{--        product_id: productId,--}}
        {{--    --}}{{--        product_name: productName,--}}
        {{--    --}}{{--        product_url: productUrl,--}}
        {{--    --}}{{--        product_price: price,--}}
        {{--    --}}{{--        product_size: product_size,--}}
        {{--    --}}{{--        product_color: product_color,--}}
        {{--    --}}{{--        product_img: imageUrl,--}}
        {{--    --}}{{--        product_quanlity: quantity,--}}
        {{--    --}}{{--        _token: '{{ csrf_token() }}'--}}
        {{--    --}}{{--    },--}}
        {{--    --}}{{--    success: function(response) {--}}
        {{--    --}}{{--        $('#add_cart_success').modal('show');--}}
        {{--    --}}{{--        console.log(response);--}}
        {{--    --}}{{--    }--}}
        {{--    --}}{{--});--}}
        {{--}--}}

    </script>
@endsection



