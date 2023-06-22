@php
    use App\Enums\OrderItemStatus;use App\Enums\OrderStatus;use App\Models\Order;use App\Models\User;
    use App\Models\Warehouse;use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;
@endphp
@extends('master')

@section('title', 'Chi tiết Đơn hàng con')

@section('content')
    <div class="card">
        <div class="">
            <h5 class="text-center">
                Chi tiết Đơn hàng con
            </h5>
        </div>
        <form action="{{route('order.item.update', $orderItem->id)}}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Apartment, studio, or floor"
                           value="{{$orderItem->product_name}}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" placeholder="$100" value="{{$orderItem->price}}"
                           disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="price" placeholder="10" value="{{$orderItem->quantity}}"
                           disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="totalPrice">Total Price</label>
                    <input type="text" class="form-control" id="totalPrice" placeholder="$1000"
                           value="{{$orderItem->total_price}}" disabled>
                </div>
            </div>
            <div class="form-row">
                @php
                    $attributeData = json_decode($orderItem->attribute, true);
                    $probs = array_keys($attributeData);
                @endphp
                @foreach($probs as $prob)
                    @if($prob == 'size' && $attributeData['size'] !== null)
                        <div class="form-group col-md-2">
                            <label for="size">Size</label>
                            <input type="text" class="form-control" id="size" placeholder="Size"
                                   value="{{ $attributeData['size'] }}" disabled>
                        </div>
                    @elseif($prob == 'color' && $attributeData['color'] !== null)
                        <div class="form-group col-md-2">
                            <label for="color">Color</label>
                            <input type="text" class="form-control" id="color" placeholder="color"
                                   value="{{ $attributeData['color'] }}" disabled>
                        </div>
                    @elseif($prob == 'model' && $attributeData['model'] !== null)
                        <div class="form-group col-md-2">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" placeholder="model"
                                   value="{{ $attributeData['model'] }}" disabled>
                        </div>
                    @elseif($prob == 'other' && $attributeData['other'] !== null)
                        <div class="form-group col-md-2">
                            <label for="{{ array_keys($attributeData[$prob])[0] }}">
                                {{ array_keys($attributeData[$prob])[0] }}
                            </label>
                            <input type="text" class="form-control" id="{{ array_keys($attributeData[$prob])[0] }}"
                                   value=" {{ array_values($attributeData[$prob])[0] }}" disabled>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="form-row">
                @php
                    $order = Order::find($orderItem->order_id);
                    if ($order->warehouse_id == null){
                        $order->warehouse_id = 1;
                    }
                    $warehouse = Warehouse::find($order->warehouse_id);
                @endphp
                <div class="form-group col-md-3">
                    <label for="order">OrderID</label>
                    <input type="text" class="form-control" id="order" placeholder="1" value="{{$orderItem->order_id}}"
                           disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="status">OrderStatus</label>
                    <input type="text" class="form-control" id="status" placeholder="status" value="{{$order->status}}"
                           disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="warehouse">WareHouse</label>
                    <input type="text" class="form-control" id="warehouse" placeholder="warehouse"
                           value="{{$warehouse->name}}" disabled>
                </div>
                @if($order->status != OrderStatus::PAYMENT_SUCCESS || $orderItem->status == OrderItemStatus::ARRIVED_WAREHOUSE)
                    <div class="form-group col-md-3">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control" disabled>
                            <option>{{$orderItem->status}}</option>
                        </select>
                    </div>
                @else
                    <div class="form-group col-md-3">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option class="text-secondary">Choose status</option>
                            <option value="{{OrderItemStatus::ARRIVED_WAREHOUSE}}">
                                {{OrderItemStatus::ARRIVED_WAREHOUSE}}
                            </option>
                        </select>
                    </div>
                @endif

            </div>
            <div class="form-group">
                <a href="{{route('order.manager.index')}}" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
@endsection
