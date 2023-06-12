@extends('master')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')

    <div class="container">
        <form method="GET" action="{{ route('search') }}">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button style="border-radius: 0;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img id="selected-image" src="https://muahang.orderhangtrung.vn/static/skins/images/logo_shop/TAOBAO-logo.png" alt="alibaba" width="105px">
                    </button>
                    <input type="hidden" name="site" id="dropdownValue" value="taobao">

                    <div class="dropdown-menu"  style="border-radius: 0;">
                        <a class="dropdown-item" href="#" onclick="changeImage('https://muahang.orderhangtrung.vn/static/skins/images/logo_shop/TAOBAO-logo.png', 'taobao')">
                            <img src="https://muahang.orderhangtrung.vn/static/skins/images/logo_shop/TAOBAO-logo.png" alt="alibaa">
                        </a>
                        <a class="dropdown-item" href="#" onclick="changeImage('https://muahang.orderhangtrung.vn/static/skins/images/logo_shop/CN1688-logo.png', '1688')">
                            <img src="https://muahang.orderhangtrung.vn/static/skins/images/logo_shop/CN1688-logo.png" alt="1688">
                        </a><a class="dropdown-item" href="#" onclick="changeImage('{{ asset('images/alibaba.png') }}', 'alibaba')">
                            <img src="{{ asset('images/alibaba.png') }}" alt="alibaba" width="105px">
                        </a>
                        <!-- Thêm các categories khác tương tự -->
                    </div>
                </div>
                <input type="text" name="text" class="form-control" placeholder="Search" aria-label="Search" style="height: 65px;">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" style="height: 65px; border: navajowhite; position: absolute; left: 90%; right: 0; z-index: 999; font-size: 30px;">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function changeImage(src, alt) {
            document.getElementById('selected-image').src = src;
            document.getElementById('selected-image').alt = alt;
            document.getElementById('dropdownValue').value = alt;
        }
        // document.addEventListener('DOMContentLoaded', function() {
        //     var firstLink = document.querySelector('.dropdown-item:first-of-type');
        //     console.log(firstLink);
        //     var firstLinkAlt = 'alibaba';
        //
        //     // Cập nhật giá trị của thẻ input
        //     document.getElementById('dropdownValue').value = firstLinkAlt;
        // });
    </script>

@endsection
