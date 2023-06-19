@php
    use App\Enums\Role;use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;

    $user = User::find(Auth::user()->id);
    $roles = $user->roles;
    $isAdmin = false;
    for ($i = 0; $i<count($roles);$i++){
        if($roles[$i]->name == Role::ADMIN){
            $isAdmin = true;
        }
    }
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
        @if($isAdmin)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Search</h5>
                    <form class="row g-3" method="post" action="{{route('order.manager.search')}}">
                        @csrf
                        <div class="col-md-4">
                            <label for="validationDefault01" class="form-label">Customer Name: </label>
                            <input name="customer_name" type="text" class="form-control" id="validationDefault01"
                                   placeholder="Johny Corn">
                        </div>
                        <div class="col-md-4">
                            <label for="validationDefault02" class="form-label">Customer Phone: </label>
                            <input name="customer_phone" type="text" class="form-control" id="validationDefault02"
                                   placeholder="+88 8-88-88">
                        </div>
                        <div class="col-md-4">
                            <label for="validationDefaultUsername" class="form-label">Customer Email: </label>
                            <input name="customer_email" type="email" class="form-control"
                                   placeholder="customer@gmail.com" id="validationDefaultUsername">
                        </div>
                        <div class="col-md-6">
                            <label for="validationDefault05" class="form-label">Customer Address: </label>
                            <input name="customer_address" type="text" class="form-control" id="validationDefault05"
                                   placeholder="1st Korea">
                        </div>
                        <div class="col-md-3">
                            <label for="validationDefault04" class="form-label">WareHouse: </label>
                            <select name="warehouse_id" class="form-control" id="validationDefault04">
                                <option selected="selected" value="">Select WareHouse</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="validationDefault04" class="form-label">Status: </label>
                            <select name="status" class="form-control" id="validationDefault04">
                                <option selected="selected" value="">Select Status</option>
                                @foreach($statusList as $status)
                                    <option>{{$status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="submit">Search</button>
                            <button class="btn btn-danger" style="margin: 8px 16px "><a
                                    href="{{route('order.manager.index')}}">Reset</a></button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <table class="table table-bordered table-hover">
            <thead>
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
            @if($listOrderItems == null)
                No order
            @elseif(count($listOrderItems) == 0)
                No order
            @else
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
                                    @if($item->status == \App\Enums\OrderItemStatus::UN_CREATED_ORDER)
                                        <button onclick="checkService({{$item->id}})" id="btn-check-service-{{$item->id}}"
                                                class="btn btn-success">Tạo đơn hàng
                                        </button>
                                    @else
                                        <button onclick="checkService({{$item->id}})" id="btn-check-service-{{$item->id}}"
                                                class="btn btn-success text-danger">Xem đơn hàng
                                        </button>
                                    @endif

                                </div>

                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>
    <script>
        function checkService(id) {
            let input = document.getElementById('input-service-' + id);
            alert('Service: ' + input.value)
        }

    </script>
@endsection
