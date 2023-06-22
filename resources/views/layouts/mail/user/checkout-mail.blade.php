<!DOCTYPE HTML>
<html xmlns:layout="http://www.ultraq.net.nz/thymeleaf/layout">
<head>
    <meta charset="UTF-8"/>
</head>
<body style="font-family: Arial;">
<table align="center" border="1" cellpadding="0" cellspacing="0"
       style="
    border: transparent;
    border-radius: 15px;
    background: linear-gradient(to right, #eedcec, #dacee6);
    width: 600px;
    text-align: center;
    ">
    <tr>
        <td>
            <h1 style="color: #2e3454; letter-spacing: 5px; font-weight: bold;">IL Team</h1>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <table
                style="border: transparent; border-radius: 15px; background: #fff; display: inline-block; border-spacing: 0px; margin: 0 50px;">
                <tr>
                    <td>
                        <img alt=""
                             src="https://imagedelivery.net/KvFcUzLL2k6Q3_ROU5d8cw/37c9970f-8e56-4543-bff5-85993b7bc600/public"
                             style="border-radius: 15px 15px 0 0; display: block;" width="100%">
                    </td>
                </tr>
                <tr>
                    <td>
                        <table style="text-align: center; display: inline-block;">
                            <tr>
                                <td>
                                    <p style="color: #2e3454;">Support | Terms and Conditions | Contact Us</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div
                                        style="font-weight:bold;font-size:20px;line-height:25px;text-align:center;color:#2e3454;">
                                        Notification mail!
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="content" style="color: #2e3454;">
                                        <p>
                                        Welcome {{$email}}!
                                        <br><br>
                                        Thank you for your order!
                                        <br><br>
                                            <a href="{{route('order.manager.index')}}">Your order has been successfully created!</a>
                                        <br><br>
                                        </p>
                                        <div class="row border">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn btn-success">
                                                    You have paid: {{$pricePercent}} {{$currency}}
                                                </div>
                                                <div class="btn btn-warning">
                                                    You are missing: {{$priceMissing}} {{$currency}}
                                                </div>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
{{--                                                    <th scope="col">#</th>--}}
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Total Price</th>
                                                    <th scope="col">Classify</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orderList as $item)
                                                    <tr>
{{--                                                        <th scope="row">{{$loop->index + 1}}</th>--}}
                                                        <td>{{$item->product_name}}</td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td>{{$item->price}}</td>
                                                        <td>{{$item->total_price}}</td>
                                                        <td>
                                                            @php
                                                                $attributeData = json_decode($item->attribute, true);
                                                                $probs = array_keys($attributeData);
                                                            @endphp
                                                            @foreach($probs as $prob)
                                                                @if($prob == 'size' && $attributeData['size'] !== null)
                                                                    <p>Size: {{ $attributeData['size'] }}</p>
                                                                @elseif($prob == 'color' && $attributeData['color'] !== null)
                                                                    <p>Color: {{ $attributeData['color'] }}</p>
                                                                @elseif($prob == 'model' && $attributeData['model'] !== null)
                                                                    <p>Model: {{ $attributeData['model'] }}</p>
                                                                @elseif($prob == 'other' && $attributeData['other'] !== null)
                                                                    <p>{{ array_keys($attributeData[$prob])[0] }}
                                                                        : {{ array_values($attributeData[$prob])[0] }}</p>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <b>Wish you have a good experience with our products</b>
                                <td style="color: #2e3454;">
                                    Best Regards,
                                    <br>
                                    IL Team.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <P style="color: #2e3454;">Copyright @2022 IL VietNam Auction</P>
        </td>
    </tr>
</table>
</body>
</html>
