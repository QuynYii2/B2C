<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/assets/img/apple-icon.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/assets/img/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/assets/img/favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Order Shopping Mall</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <!-- CSS Files -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/assets/css/light-bootstrap-dashboard.css?v=2.0.0')}}" rel="stylesheet"/>
    <link href="{{asset('/assets/css/demo.css')}}" rel="stylesheet"/>
    <link href="{{asset('/assets/css/custom.css')}}" rel="stylesheet"/>
</head>

<body>
<div class="wrapper">
    @include('layouts.sidebar')
    <div class="main-panel">
        @include('layouts.header')
        <div class="content">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
</div>

</body>
<!--   Core JS Files   -->
<script src="{{asset('/assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/plugins/bootstrap-switch.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script src="{{asset('/assets/js/plugins/chartist.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/plugins/bootstrap-notify.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/light-bootstrap-dashboard.js?v=2.0.0')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/demo.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        let percentSearchTaobao = 0;
        let percentSearch1688 = 0;
        let percentSearchAlibaba = 0;

        let percentOrderTaobao = 0;
        let percentOrder1688 = 0;
        let percentOrderAlibaba = 0;

        $.ajax({
            url: '/statistic-order-search',
            method: 'GET',
            success: function (response) {
                let totalSearch = 0;
                let searchTaobao = 0;
                let search1688 = 0;
                let searchAlibaba = 0;

                let totalOrder = 0;
                let orderTaobao = 0;
                let order1688 = 0;
                let orderAlibaba = 0;
                for (let i = 0; i < response.length; i++) {
                    if (response[i]['service'] == 'taobao') {
                        searchTaobao = searchTaobao + response[i]['statistic_search'];
                        orderTaobao = orderTaobao + response[i]['statistic_order'];
                    } else if (response[i]['service'] == '1688') {
                        search1688 = search1688 + response[i]['statistic_search'];
                        order1688 = order1688 + response[i]['statistic_order'];
                    } else {
                        searchAlibaba = searchAlibaba + response[i]['statistic_search'];
                        orderAlibaba = orderAlibaba + response[i]['statistic_order'];
                    }
                }
                totalSearch = totalSearch + searchTaobao + search1688 + searchAlibaba;
                totalOrder = totalOrder + orderTaobao + order1688 + orderAlibaba;
                // search percent
                percentSearchTaobao = parseFloat(searchTaobao / totalSearch * 100).toFixed(2);
                percentSearch1688 = parseFloat(search1688 / totalSearch * 100).toFixed(2);
                percentSearchAlibaba = parseFloat(100 - percentSearchTaobao - percentSearch1688).toFixed(2);
                // order percent
                percentOrderTaobao = parseFloat(orderTaobao / totalOrder * 100).toFixed(2);
                percentOrder1688 = parseFloat(order1688 / totalOrder * 100).toFixed(2);
                percentOrderAlibaba = parseFloat(100 - percentOrderTaobao - percentOrder1688).toFixed(2);

                demo.getChartStatisticSearch(parseFloat(percentSearchTaobao), parseFloat(percentSearch1688), parseFloat(percentSearchAlibaba));
                demo.getChartStatisticOrder(parseFloat(percentOrderTaobao), parseFloat(percentOrder1688), parseFloat(percentOrderAlibaba));

            },
            error: function (response) {
                console.log(response)
            }
        });


        demo.initDashboardPageCharts();
    });


    function increaseNumber() {
        var input = document.getElementById('myNumber');
        input.value = parseInt(input.value) + 1;
    }

    function decreaseNumber() {
        var input = document.getElementById('myNumber');
        if (input.value > 0) {
            input.value = parseInt(input.value) - 1;
        }
    }

    var product_size = ''; // Biến lưu trữ size
    var product_color = '';// Biến lưu trữ color
    var product_model = '';// Biến lưu trữ model
    var attribute_array = {};

    function myFun(id) {
        var labelSelect = document.getElementById('label-' + id);
        var labelText = document.getElementById('id-label-other-' + id).innerText;
        attribute_array[labelText] = labelSelect.value;
        console.log(attribute_array)
    }

    $(document).ready(function () {
        product_size = $('#labelsize').val();
        product_color = $('#labelcolor').val();
        product_model = $('#labelmodel').val();

        var inputProps = document.getElementsByClassName('input-hidden');
        for (i = 0; i < inputProps.length; i++) {
            var value = inputProps[i].value;
            myFun(value);
        }
    });

    $('#labelsize').change(function () {
        product_size = $(this).val();
    });

    $('#labelcolor').change(function () {
        product_color = $(this).val();
    });

    $('#labelmodel').change(function () {
        product_model = $(this).val();
    });

    $('.label-select').change(function () {
        var inputProps = document.getElementsByClassName('input-hidden');
        for (i = 0; i < inputProps.length; i++) {
            var value = inputProps[i].value;
            myFun(value);
        }

    });

    // product_model: product_model,
    // attribute_array: attribute_array.toString(),

    $('#btn-order-now').on('click', function () {
        var productId = $(this).data('product-id');
        var price = document.querySelector('.price b').innerText;
        var productName = document.querySelector('#product_name').innerText;
        var productUrl = document.querySelector('#product_url').innerText;
        var sizeList = document.getElementById('sizeList');
        var colorList = document.getElementById('colorList');

        var quantity = document.getElementById('myNumber').value;
        console.log(quantity, price);

        var imageElement = document.getElementById('thumb_product');
        var imageUrl = imageElement.src;

        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                product_id: productId,
                product_name: productName,
                product_url: productUrl,
                product_price: price,
                product_size: product_size,
                product_color: product_color,
                product_model: product_model,
                attribute_array: attribute_array,
                product_img: imageUrl,
                product_quanlity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#add_cart_success').modal('show');
                console.log(response);
            },
            error: function (response) {
                console.log(response)
            }
        });
    });

    $('.decrease-number').click(function (e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        var input = $(this).next('input');
        var quantity = parseInt(input.val());
        if (quantity > 0) {
            quantity--;
            input.val(quantity);
            updateCartQuantity(itemId, quantity);
        }
    });

    $('.increase-number').click(function (e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        var input = $(this).prev('input');
        var quantity = parseInt(input.val());
        quantity++;
        input.val(quantity);
        updateCartQuantity(itemId, quantity);
    });

    function updateCartQuantity(itemId, quantity) {
        console.log(1111)
        $.ajax({
            url: '/update-cart-quantity',
            method: 'POST',
            data: {
                itemId: itemId,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                alert('Cập nhật số lượng sản phẩm trong giỏ hàng thành công !')
                var itemElement = document.querySelector('[data-item-id="' + itemId + '"]');
                var quantityElement = itemElement.querySelector('#myNumber');
                var totalPriceElement = itemElement.querySelector('#totalPrice' + itemId);
                var priceTotalElement = document.getElementById('price_total');
                quantityElement.value = quantity;
                totalPriceElement.textContent = response.totalPrice;
                $('#price_total').text(response.priceTotal);
            },
            error: function (xhr) {
            }
        });
    }

    function deleteCartItem(itemId) {
        var confirmation = confirm("Bạn có chắc chắn muốn xóa mục này?");

        if (confirmation) {
            axios.delete('/delete-cart-item/' + itemId)
                .then(function (response) {
                    if (response.data.success) {
                        var itemElement = document.querySelector('[data-item-id="' + itemId + '"]');
                        if (itemElement) {
                            itemElement.remove();
                            alert("Xóa thành công!");
                        }
                    } else {
                    }
                })
                .catch(function (error) {
                });
        }
    }

    function deleteAllCartItems() {
        var confirmation = confirm("Bạn có chắc chắn muốn xóa tất cả các mục trong giỏ hàng?");

        if (confirmation) {
            axios.delete('/delete-all-cart-items')
                .then(function (response) {
                    if (response.data.success) {
                        var cartItems = document.querySelectorAll('.row.border-top.border-bottom');
                        if (cartItems) {
                            cartItems.forEach(function (item) {
                                item.remove();
                                alert("Xóa thành công!");
                            });
                        }
                    } else {
                    }
                })
                .catch(function (error) {
                });
        }
    }

    // Xử lý sự kiện click nút thanh toán
    $('#checkoutButton').on('click', function (e) {
        console.log(1111);
        e.preventDefault();

        var checkoutUrl = $(this).attr('href');
        var name = $("input[name=full_name]").val();
        var address = $("input[name=address]").val();
        var phone = $("input[name=phone]").val();
        var mail = $("input[name=mail]").val();
        var paymentMethod = $('#payment_method').val();

        $.ajax({
            url: checkoutUrl,
            type: 'POST',
            data: {
                name: name,
                address: address,
                phone: phone,
                mail: mail,
                paymentMethod: paymentMethod,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#checkoutSuccessModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });


</script>

</html>
