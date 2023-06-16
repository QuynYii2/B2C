@php
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;
@endphp
@extends('master')

@section('title', 'Quản lý Đơn hàng')

@section('content')
    <div class="card">
        <div class="">
            <h5 class="text-center">
                Quản lý Đơn hàng
            </h5>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
            @php
                $user = User::find(Auth::user()->id);
                $roles = $user->roles;
                $isAdmin = false;
                for ($i = 0; $i<count($roles);$i++){
                    if($roles[$i]->name == \App\Enums\Role::ADMIN){
                        $isAdmin = true;
                    }
                }
            @endphp
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total Price</th>
                <th scope="col">Classify</th>
                @if($isAdmin)
                    <th scope="col">Action</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($listOrderItems as $item)
                <tr>
                    <th scope="row">{{$loop->index + 1}}</th>
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
                    @if($isAdmin)
                        <td>
                            @php
                                $isTaobao = false;
                                $is1688 = false;
                                $isAlibaba = false;
                                $service = null;
                                 if (Str::contains($item->product_url, 'taobao')){
                                     $service = 'taobao';
                                     $isTaobao = true;
                                 } elseif (Str::contains($item->product_url, '1688')){
                                     $service = '1688';
                                     $is1688 = true;
                                 } else {
                                      $service = 'alibaba';
                                     $isAlibaba = true;
                                 }
                            @endphp
                            <input id="input-service-{{$item->id}}" name="service" value="{{$service}}" hidden>
                            <div class="d-flex">
                                <a class="btn btn-primary" href="{{route('order.manager.review', $item->id)}}">
                                    Chi tiết
                                </a>
                                <button onclick="checkService({{$item->id}})" id="btn-check-service-{{$item->id}}" class="btn btn-success">Tạo đơn hàng</button>
                            </div>

                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function checkService(id) {
            let input = document.getElementById('input-service-' + id);
            alert('Service: '+input.value)
        }

    </script>
@endsection
