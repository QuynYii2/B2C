@extends('frontend.layouts.master')

@section('title', 'Home page')

@section('content')
    <style>
        #mainDetailProduct > #left-col > .card {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5rem;
        }

        .d-flex > svg {
            width: 40px;
            height: 40px;
        }

        .labels > div {
            width: 150px;
            position: absolute;
        }

        .labels > div.label-new {
            left: -40px;
            top: 20px;
            transform: rotate(-45deg);
        }

        .labels > div.label-sale {
            right: -40px;
            top: 20px;
            transform: rotate(45deg);
        }

        .card {
            overflow: hidden;
            box-shadow: 0 3px 17px rgba(0, 0, 0, 0.15), 0 0 5px rgba(0, 0, 0, 0.15);
            background-color: #f7f7f7;
        }

        .card img {
            width: 100%;
            height: auto !important;
        }

        .description {
            text-align: center;
        }

        .description p {
            text-align: left;
        }

        .btn {
            padding: 8px 16px;
            /*margin: 0 16px;*/
        }


        .btn:hover {
            background-color: #00bf90;
        }

        .tabs-product-detail {
            background-color: #fff !important;
        }

        .link-tabs:hover {
            color: #c69500 !important;
        }

        .text-more-tabs:hover {
            color: #c69500 !important;
        }

        .product-content {
            padding-top: 0;
        }

        .product-content p {
            margin-bottom: 0;
        }

        #img-default {
            cursor: pointer;
        }

        .img-focus {
            cursor: pointer;
        }

        .btn-16 {
            margin: 0 16px;
        }

        .btn-cancel:hover {
            background-color: #cccccc;
        }

        .checked {
            color: orange;
        }

        .list-items-ml-0 {
            margin-left: 0;
        }

        @media only screen and (min-width: 1200px) {
            .tabs-product {

            }

            .img-focus {
                width: 80px;
                height: 80px;
                cursor: pointer;
            }
        }

        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .tabs-product {

            }

            .img-focus {
                width: 80px;
                height: 80px;
            }
        }

        @media only screen and (min-width: 769px) and (max-width: 991px) {
            .tabs-item {
                max-width: 120px;
            }

            .tabs-item a {
                font-size: 15px;
            }

            .tabs-product {
                display: flex !important;
            }
        }

        @media only screen and (max-width: 769px) {
            .tabs-item {
                max-width: 120px;
            }

            .tabs-item a {
                font-size: 15px;
            }
        }

        @media only screen and (max-width: 767px) {
            .tabs-item {
                max-width: 100px;
            }

            .tabs-item a {
                font-size: 15px;
            }

            .img-focus {
                width: 80px;
                height: 80px;
            }
        }

        @media only screen and (max-width: 365px) {
            .tabs-item {
                max-width: 70px;
            }

            .tabs-item a {
                font-size: 12px;
            }

            .btn-block {
                display: block;
            }

            .img-focus {
                width: 60px;
                height: 60px;
            }
        }

        .bonnus-price-img {
            width: 60px !important;
        }

        .img-choose {
            cursor: pointer;
            width: 35px !important;
            height: 35px !important;
        }


    </style>
    @php
        $product = \App\Models\Product::find(1);
    @endphp
    <div class="container">
        <div class="row mb-5 mt-5" id="mainDetailProduct">
            <div class="col-md-10" id="left-col">
                <div class="card tabs-product" id="id-tabs-product" style="padding: 8px">
                    <div class="product-imgs " id="product">
                        <div class="img-display ">
                            <div class="img-showcase d-flex flex-row bd-highlight ">
                                <img id="img-default" class="img" src="{{$product->thumbnail}}"
                                     alt="image" width="360px" height="250px" data-toggle="modal"
                                     data-target="#seeImageProduct">
                                <input id="img-rollback" value="{{$product->thumbnail}}" hidden="" disabled>

                                <div class="modal fade" id="seeImageProduct" tabIndex="-1" role="dialog"
                                     aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Váy hai mảnh giả màu xanh nữ mùa hè 2023 thiết kế khí chất Pháp mới
                                                    phù hợp với váy dài
                                                    đến mắt cá chân</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row d-flex justify-content-between">
                                                    <div class="col-md-10 img-main">
                                                        <img class="img" id="img-modal" src="{{$product->thumbnail}}"
                                                             alt="">
                                                    </div>
                                                    <div class="col-md-2 img-second">
                                                        <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                             src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg"
                                                             alt="">
                                                        <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                             src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                                             alt="">
                                                        <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                             src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                                             alt="">
                                                        <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                             src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg"
                                                             alt="">
                                                        <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                             src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                                             alt="">
                                                    </div>
                                                    <div class="">
                                                        <button class="btn btn-secondary btn-16 btn-cancel mr-5"
                                                                data-dismiss="modal"
                                                                aria-label="Close">Cancel
                                                        </button>
                                                        <button class="btn btn-danger" id="btn-buy-modal"
                                                                onclick="orderClick();">Buy now
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="img-select d-flex flex-row bd-highlight mb-2 mt-2">
                            <div class="img-item">
                                <img class="img img-focus" onclick="zoomImg(this)"
                                     src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg"
                                     alt="shoe image">
                            </div>
                            <div class="img-item">
                                <img class="img img-focus" onclick="zoomImg(this)"
                                     src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                     alt="shoe image">
                            </div>
                            <div class="img-item">
                                <img class="img img-focus" onclick="zoomImg(this)"
                                     src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                     alt="shoe image">
                            </div>
                            <div class="img-item">
                                <img class="img img-focus" onclick="zoomImg(this)"
                                     src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg"
                                     alt="shoe image">
                            </div>
                            <div class="img-item">
                                <img class="img img-focus" onclick="zoomImg(this)"
                                     src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                     alt="shoe image">
                            </div>
                        </div>
                    </div>
                    <div class="" style="z-index: 88;">
                        <form>
                            <h5>Váy hai mảnh giả màu xanh nữ mùa hè 2023 thiết kế khí chất Pháp mới phù hợp với váy dài
                                đến mắt cá chân</h5>
                            <div class="p-2">
                                <img class="img"
                                     src="https://img.alicdn.com/imgextra/i4/O1CN017Htaw91fIilbli3Lw_!!6000000003984-0-tps-480-40.jpg">
                                <p class="product-price">
                                <p class="last-price">Gia cu:
                                    <span>${{$product->price + ($product->price*5/100)}}</span></p>
                                <p class="new-price">Gia taobao:
                                    <span class="text-danger price-taobao" style="font-size: 36px">${{$product->price}} (<span>5%</span>)</span>
                                </p>
                                <p class="bonnus-price">Giam gia:
                                <p>Phieu giam gia loai 1</p>
                                </p>
                            </div>
                            <label for="size">{{ __('home.size') }}: </label>
                            <select id="size" name="size">
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                            </select>
                            <div class="">
                                <span>Chon mau sac:</span>
                                <ul class="d-flex">
                                    <li class="mr-3">
                                        <img onclick="zoomImg(this)"
                                             src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                             class="img img-choose">
                                    </li>
                                    <li>
                                        <img onclick="zoomImg(this)"
                                             src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                             class="img img-choose">
                                    </li>
                                </ul>
                            </div>

                            <div class="count__wrapper count__wrapper--ml mt-3">
                                <label for="qty">{{ __('home.quantity') }}</label>
                                <input class="product-qty input" type="number" name="quantity" min="0"
                                       style="width: 55px"
                                       value="1">
                            </div>

                            <div class="purchase-info d-flex mt-3">
                                <button type="button" class="btn btn-warning">
                                    {{ __('home.installment by card') }}
                                </button>
                                <button type="submit" class="btn-danger btn btn-16" id="btn-order-now"><i
                                            class="fa fa-shopping-cart"></i>
                                    {{ __('home.buy now') }}
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 mt-4 bg-white border">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item tabs-product-detail tabs-item">
                            <a class="nav-link lead active link-tabs" role="tab" data-toggle="tab"
                               href="#tabIntroduce">{{ __('home.introduce taobao') }}</a>
                        </li>
                        <li class="nav-item tabs-product-detail tabs-item">
                            <a class="nav-link lead link-tabs" role="tab" data-toggle="tab"
                               href="#tabBankGuidePayment">{{ __('home.bank guide payment') }}</a>
                        </li>
                        <li class="nav-item tabs-product-detail tabs-item">
                            <a class="nav-link lead link-tabs" role="tab" data-toggle="tab"
                               href="#tabImmediacyPayment">{{ __('home.immediacy payment') }}</a>
                        </li>
                        <li class="nav-item tabs-product-detail tabs-item">
                            <a class="nav-link lead link-tabs" role="tab" data-toggle="tab"
                               href="#tabSecurity">{{ __('home.security') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="description tab-pane active show" role="tabpanel" id="tabIntroduce">

                        </div>

                        <div class="tab-pane pt-4" role="tabpanel" id="tabBankGuidePayment">
                            <img class="img mb-3" src="https://gtms01.alicdn.com/tps/i4/T1nN9fXiBpXXXXXXXX-685-50.png">
                        </div>

                        <div class="tab-pane pt-4" role="tabpanel" id="tabImmediacyPayment">
                            <img src="https://gtms01.alicdn.com/tps/i1/T1oN9fXiBpXXXXXXXX-468-50.png" alt=""
                                 class="img">
                            <div class="mb-3 mt-3">
                                Xem giới thiệu phương thức thanh toán chi tiết
                            </div>
                        </div>

                        <div class="tab-pane pt-4" role="tabpanel" id="tabSecurity">
                            <div class="m-3">
                                支付宝担保交易：使用支付宝“收货满意后，卖家才能拿到钱”保障您的交易安全，让您购物没有后顾之忧！
                                支付宝提供24小时资金监控，风控体系保障“支付宝账户”360度安全！
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-2 border p-0">
                <div class="">
                    <img class="img" src="https://gtms01.alicdn.com/tps/i1/TB1KcJOFVXXXXb5XXXXTnAu0VXX-396-120.png"
                         alt="">
                </div>
                <div class="border-bottom"></div>
                <div class="text-center">
                    9 product
                </div>
                <div class="border-bottom"></div>
                <div class="mt-3 ml-3">
                    <h5 class="">
                        <a href="#">Kỳ Lân STUDIO</a>
                    </h5>
                    <div class="">
                        <span>Danh tieng:</span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                    </div>
                    <div class="">
                        <span>Ket noi:</span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>

                    </div>
                    <div class="">
                        <span>Trinh do chuyen mon:</span>
                        <span><i id="icon-star-1"
                                 class="fa fa-star"></i></span>
                    </div>
                </div>
                <div class="border-bottom"></div>
                <div class="m-2">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="">
                                action
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                action
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                action
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-1 border text-center">
                                MAX
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-1 border text-center">
                                MAX
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom"></div>
                <div class="row m-2">
                    <div class="">
                        show and show
                    </div>
                    <div class="col-md-6 mb-2 mt-2">
                        <a href="#"> <img class="img"
                                          src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                          alt=""></a>
                        <div class="text-center text-danger">
                            <span>$99</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2 mt-2">
                        <a href="#"> <img class="img"
                                          src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                          alt=""></a>
                        <div class="text-center text-danger">
                            <span>$99</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2 mt-2">
                        <a href="#"> <img class="img"
                                          src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                          alt=""></a>
                        <div class="text-center text-danger">
                            <span>$99</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2 mt-2">
                        <a href="#"> <img class="img"
                                          src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                          alt=""></a>
                        <div class="text-center text-danger">
                            <span>$99</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row MT-4">
            <div class="col-md-3">
                <div class="card  mb-5">
                    <div class="input-group ml-3 mt-3">
                        <form class="pb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{ __('home.search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="button"><i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="w-100">
                        <div class="" style="background-color: #4bd7ef; color: #fff;">
                            <span class="ml-3">tìm kiếm cửa hàng</span>
                        </div>
                        <div class="mt-2 ml-2">
                            <form>
                                <label for="fname" >Key:</label>
                                <input type="text" size="16"><br>
                                <label for="lname">About price:</label>
                                <input type="text" maxlength="1" size="4" placeholder="$...">
                                <span class=""> - </span>
                                <input type="text" minlength="2" size="4" placeholder="$..."><br>
                                <button type="" class="btn btn-success">Search</button>
                            </form>
                        </div>
                        <div class="mt-3" style="background-color: #4bd7ef; color: #fff;">
                            <span class="ml-3">Phan loai hang</span>
                        </div>
                        <div class="mt-2 ml-2">
                            <article class="filter-group">
                                <header class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true"
                                       class="toggle-link">
                                        <i class="icon-control fa fa-chevron-down"></i>
                                        <span class="title title-search">{{ __('home.product type') }}</span>
                                    </a>
                                </header>
                                <div class="filter-content collapse show" id="collapse_1" style="">
                                    <div class="card-body">
                                        <ul class="list-menu">
                                            <li><a href="#">{{ __('home.people') }}</a></li>
                                            <li><a href="#">{{ __('home.watches') }}</a></li>
                                            <li><a href="#">{{ __('home.cinema') }}</a></li>
                                            <li><a href="#">{{ __('home.clothes') }}</a></li>
                                            <li><a href="#">{{ __('home.home items') }}</a></li>
                                            <li><a href="#">{{ __('home.animals') }}</a></li>
                                        </ul>
                                    </div> <!-- card-body.// -->
                                </div>
                            </article>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8 bg-white">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item tabs-product-detail tabs-item">
                        <a class="nav-link lead active link-tabs" role="tab" data-toggle="tab"
                           href="#tabDescription">{{ __('home.description') }}</a>
                    </li>
                    <li class="nav-item tabs-product-detail tabs-item">
                        <a class="nav-link lead link-tabs" role="tab" data-toggle="tab"
                           href="#tabSpecification">{{ __('home.specification') }}</a>
                    </li>
                    <li class="nav-item tabs-product-detail tabs-item">
                        <a class="nav-link lead link-tabs" role="tab" data-toggle="tab"
                           href="#tabReview">{{ __('home.review') }}</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="description tab-pane active show" role="tabpanel" id="tabDescription">
                        <p>
                            Sở hữu thiết kế tinh tế, màn hình xuất sắc và cấu hình mạnh mẽ, đáp ứng được hầu hết nhu
                            cầu
                            của một người sáng tạo chuyên nghiệp. Điều khó có một thế hệ máy tính bảng nào khác có
                            thể
                            làm được, đã xuất hiện trên iPad Pro 12.9 inch Wifi (2020).

                            Màn hình tuyệt đẹp, nhiều công nghệ tích hợp

                            iPad Pro 12.9 inch 2020 có một thiết kế khá vuông vức với viền màn hình 4 cạnh không quá
                            dày
                            và đều nhau, giúp cho trải nghiệm cầm nắm dễ dàng, giúp cho tổng thể mặt trước của iPad
                            hài
                            hòa và đẹp mắt hơn.
                        </p>

                        <div class="collapse" id="more">
                            <p>
                                Tổng thể chiếc máy có khối lượng chỉ 471 g và mỏng 5.9 mm so với kích thước 12.9
                                inch
                                thì điều đó cho thấy iPad Pro 12.9 inch 2020 rất mỏng nhẹ, gọn gàng.

                                Trên tay kích thước iPad Pro 12.9 2020

                                Thật khó lòng khi tìm ra khuyết điểm về màn hình của iPad Pro 12.9 inch 2020, với
                                kích
                                thước 12.9 inch cùng với độ phân giải 2048 x 2732 pixels giúp cho máy hiển thị vô
                                cùng
                                sắc nét và không gian làm việc lớn.

                                Xem thêm: Tìm hiểu về các loại độ phân giải màn hình

                                kích thước màn hình iPad Pro 12.9 2020

                                Máy sử dụng công nghệ màn hình Liquid Retina Display với các công nghệ hỗ trợ như
                                Pro
                                Motion và True Tone, giúp màu sắc được thể hiện một cách tự nhiên, trung thực và
                                sống
                                động.

                                Xem thêm: Màn hình Retina là gì?

                                màn hình hiển thị trên iPad Pro 12.9 2020

                                Hiệu năng mạnh mẽ với chip CPU A12Z với 8 nhân đồ họa

                                iPad Pro 12.9 inch 2020 được trang bị bộ vi xử lý Apple A12Z Bionic mạnh mẽ hơn
                                người
                                tiền nhiệm, giúp cho thao tác sử dụng những phần mềm đồ họa như Photoshop,
                                illustrator
                                mượt mà và phản hồi nhanh chóng hơn.

                                Cấu hình iPad Pro 2020

                                Với việc có thể kết nối với bàn phím, chuột không dây và con trỏ chuột được làm mới,
                                giúp người dùng thao tác và sử dụng một cách dễ dàng.

                                iPad Pro 12.9 2020 kết nối bàn phím

                                Hơn thế nữa, bộ vi xử lý A12Z với 8 nhân đồ hoạ thì máy có thể chiến hầu hết các tựa
                                game hiện có trên thị trường như PUBG, Liên Quân, Asphalt 9,… với mức thiết lập đồ
                                họa
                                cao nhất với tốc độ khung hình ổn định trong suốt quá trình chơi.

                                chơi game với iPad Pro 12.9 2020

                                Bằng việc tích hợp sẵn bộ nhớ trong 128 GB giúp cho người dùng có nhiều không gian
                                lưu
                                trữ hơn, làm được nhiều việc hơn trên chiếc iPad Pro 12.9 inch 2020. Đây là mức dung
                                lượng hoàn hảo cho tùy chọn cơ bản nhất của chiếc máy.

                                Bộ nhớ trên iPad Pro 12.9 2020

                                Cụm camera “Pro”, nâng tầm trải nghiệm AR

                                Apple thật sự ưu ái khi tích hợp cho chiếc máy này với 2 camera sau, 1 camera chính
                                12
                                MP và 1 camera góc siêu rộng 125 độ 10 MP, cùng với đó là camera selfie 7 MP hỗ trợ
                                công
                                nghệ TrueDepth. Giúp bạn hoàn toàn có thể chụp ra những bức ảnh ưng ý nhất.

                                Cụm camera trên iPad Pro 12.9 2020

                                Việc quay video, chụp ảnh và chỉnh sửa trực tiếp một cách chuyên nghiệp để gửi đi
                                khách
                                hàng, đối tác chỉ với một thiết bị duy nhất đã không còn là điều xa vời với người
                                dùng
                                iPad Pro 2020.

                                Hơn thế nữa, iPad Pro 12.9 inch 2020 còn được tích hợp thêm cảm biến Lidar đo chiều
                                sâu,
                                giúp hỗ trợ những ứng dụng AR nhận diện bối cảnh một cách chính xác nhất.

                                Lidar hỗ trợ AR trên iPad Pro 12.9 2020

                                Cảm biến này cực kì hữu ích đặc biệt trong các lĩnh vực thiết kế, thi công bởi người
                                dùng có thể “ướm” thử các mô hình 3D của thiết kế lên thực tế và quan sát nhiều góc
                                độ
                                một cách trực quan nhất bằng công nghệ thực tại ảo AR.
                            </p>
                        </div>

                        <a href="#more" data-toggle="collapse" class="more-link text-center text-more-tabs"
                           id="more-link"
                           onclick="toggleReadMore()">{{ __('home.read more') }}</a>
                    </div>


                    <div class="tab-pane pt-4" role="tabpanel" id="tabSpecification">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td colspan="2"><strong>Memory</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>test 1</td>
                                <td>16GB</td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <td colspan="2"><strong>Processor</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No. of Cores</td>
                                <td>4</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane pt-4" role="tabpanel" id="tabReview">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="">{{ __('home.write a read') }}</div>
                                <form method="post" action="{{route('create.evaluate')}}">
                                    @csrf
                                    <input type="text" class="form-control" id="product_id" name="product_id"
                                           hidden/>
                                    <div class="rating">
                                        <input type="radio" name="star_number" id="star1" value="1" hidden="">
                                        <label for="star1" onclick="starCheck(1)"><i id="icon-star-1"
                                                                                     class="fa fa-star"></i></label>
                                        <input type="radio" name="star_number" id="star2" value="2" hidden="">
                                        <label for="star2" onclick="starCheck(2)"><i id="icon-star-2"
                                                                                     class="fa fa-star"></i></label>
                                        <input type="radio" name="star_number" id="star3" value="3" hidden="">
                                        <label for="star3" onclick="starCheck(3)"><i id="icon-star-3"
                                                                                     class="fa fa-star"></i></label>
                                        <input type="radio" name="star_number" id="star4" value="4" hidden="">
                                        <label for="star4" onclick="starCheck(4)"><i id="icon-star-4"
                                                                                     class="fa fa-star"></i></label>
                                        <input type="radio" name="star_number" id="star5" value="5" hidden="">
                                        <label for="star5" onclick="starCheck(5)"><i id="icon-star-5"
                                                                                     class="fa fa-star"></i></label>
                                    </div>

                                    <div class="form-group row">
                                        <label for=""
                                               class="col-sm-12 col-form-label">{{ __('home.your name') }}</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="" name="username"
                                                   placeholder="{{ __('home.your name') }}" required/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for=""
                                               class="col-sm-12 col-form-label">{{ __('home.your review') }}</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="" name="content"
                                                      placeholder="{{ __('home.your review') }}"
                                                      rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <button class="btn btn-primary btn-16" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">{{ __('home.write a review') }}</div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function zoomImg(x) {
            imgDf = document.getElementById('img-default');
            imgDf.src = x.src;
        }

        function normalImg() {
            imgDf = document.getElementById('img-default');
            imgRollback = document.getElementById('img-rollback').value;
            imgDf.src = imgRollback;
        }

        function zoomImgModal(x) {
            imgDf = document.getElementById('img-modal');
            imgDf.src = x.src;
        }

        function orderClick() {
            btnOrder = document.getElementById('btn-order-now');
            btnOrder.click();

        }

        function toggleReadMore() {
            var moreLink = document.getElementById("more-link");
            var moreContent = document.getElementById("more");
            var readMore = '{{ __("home.read more") }}';
            var readLess = '{{ __("home.read less") }}';

            if (moreContent.classList.contains("show")) {
                moreLink.textContent = readMore;
            } else {
                moreLink.textContent = readLess;
            }
        }

        let urlParams = window.location.href;
        let myParam = urlParams.split('/');
        let num = myParam.length;
        console.log(myParam[num - 1]);
        document.getElementById("product_id").value = myParam[num - 1];

        function myFunction(x) {
            let tabs = document.getElementById('id-tabs-product');
            if (x.matches) {
                tabs.classList.remove("card");
                tabs.classList.add("border");
                console.log('b')
            }
        }

        var x = window.matchMedia("(max-width: 770px)")
        myFunction(x)
        x.addListener(myFunction)

        function responsiveTable(y) {
            let tabs = document.getElementsByClassName('product-other');
            console.log(tabs.length)
            var i;
            for (i = 0; i < tabs.length; i++) {
                if (y.matches) {
                    tabs[i].classList.remove("col-md-3");
                    tabs[i].classList.add("col-sm-6");
                }
            }

        }

        var y = window.matchMedia("(max-width: 991px)")
        responsiveTable(y);
        x.addListener(responsiveTable)
    </script>
@endsection