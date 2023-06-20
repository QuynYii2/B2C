@php use App\Enums\WarehouseStatus; @endphp
@extends('master')

@section('title', 'Tạo mới kho hàng')

@section('content')
    <div class="card">
            <div class="">
                <h5 class="text-center">Danh sách kho hàng</h5>
            </div>
            <form method="post" action="{{route('warehouse.create')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address"
                           required>
                </div>
                <div class="form-group">
                    <label for="country">ADDRESS TO</label>
                    <select id="country" name="country" class="form-control">
                        <option value="vi">Viet Nam</option>
                        <option value="kr">Korea</option>
                        <option value="cn">China</option>
                        <option value="jp">Japan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        @foreach($listStatus as $status)
                            @if($status != WarehouseStatus::DELETED)
                                <option value="{{$status}}">{{$status}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>
@endsection


