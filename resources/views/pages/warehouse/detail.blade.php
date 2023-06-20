@php use App\Enums\WarehouseStatus; @endphp
@extends('master')

@section('title', 'Chi tiết kho hàng')

@section('content')
    <div class="card">
            <div class="">
                <h5 class="text-center">Chi tiết kho hàng</h5>
            </div>
            <form method="post" action="{{route('warehouse.update', $warehouse->id)}}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                           value="{{$warehouse->name}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                           value="{{$warehouse->email}}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone"
                           value="{{$warehouse->phone}}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address"
                           value="{{$warehouse->address}}" required>
                </div>
                <div class="form-group">
                    <label for="country">ADDRESS TO</label>
                    <select id="country" name="country" class="form-control">
                        @if($warehouse->country == 'vi')
                            <option value="vi">Viet Nam</option>
                            <option value="kr">Korea</option>
                            <option value="cn">China</option>
                            <option value="jp">Japan</option>
                        @elseif($warehouse->country == 'kr')
                            <option value="kr">Korea</option>
                            <option value="vi">Viet Nam</option>
                            <option value="cn">China</option>
                            <option value="jp">Japan</option>
                        @elseif($warehouse->country == 'cn')
                            <option value="cn">China</option>
                            <option value="vi">Viet Nam</option>
                            <option value="kr">Korea</option>
                            <option value="jp">Japan</option>
                        @else
                            <option value="jp">Japan</option>
                            <option value="vi">Viet Nam</option>
                            <option value="kr">Korea</option>
                            <option value="cn">China</option>
                        @endif

                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        @if($warehouse->status == WarehouseStatus::ACTIVE)
                            <option value="{{WarehouseStatus::ACTIVE}}">ACTIVE</option>
                            <option value="{{WarehouseStatus::INACTIVE}}">INACTIVE</option>
                        @else
                            <option value="{{WarehouseStatus::INACTIVE}}">INACTIVE</option>
                            <option value="{{WarehouseStatus::ACTIVE}}">ACTIVE</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>
@endsection

