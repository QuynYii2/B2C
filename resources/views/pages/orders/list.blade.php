@php
    use App\Enums\OrderStatus;use App\Enums\Role;use App\Models\User;
    use App\Models\Warehouse;use Illuminate\Support\Facades\Auth;

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
        @if (session('success'))
            <h5 class="text-center text-success">
                {{ session('success') }}
            </h5>
        @endif
        @if($isAdmin)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Search</h5>
                    <form class="row g-3" method="post" action="{{route('order.list.search')}}">
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
                                    href="{{route('order.list')}}">Reset</a></button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Phone</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Customer Address</th>
                <th scope="col">WareHouse</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($orders == null)
                No order
            @else
                @foreach($orders as $item)
                    @if($item->status != OrderStatus::DELETED)
                        <tr>
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$item->customer_name}}</td>
                            <td>{{$item->customer_phone}}</td>
                            <td>{{$item->customer_email}}</td>
                            <td>{{$item->customer_address}}</td>
                            <td>
                                @php
                                    $warehouse = Warehouse::find($item->warehouse_id);
                                @endphp
                                {{$warehouse->name}}
                            </td>
                            <td>{{$item->status}}</td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-primary">
                                        <a href="{{route('order.detail', $item->id)}}">Chi tiết</a>
                                    </button>
                                    @if($isAdmin)
                                        {{--                                        <button type="button" class="btn btn-primary" data-toggle="modal"--}}
                                        {{--                                                data-target="#exampleModal"--}}
                                        {{--                                                data-action="{{route('order.update',  $item->id)}}">--}}
                                        {{--                                            Sửa trạng thái--}}
                                        {{--                                        </button>--}}
                                        <button type="button"
                                                class="btn btn-primary"
                                                onclick="sumbit('{{route('order.update',  $item->id)}}')">
                                            Sửa trạng thái
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="post" id="form-changeStatus">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Sửa trạng thái</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="{{OrderStatus::ARRIVED_WAREHOUSE}}">{{OrderStatus::ARRIVED_WAREHOUSE}}</option>
                                <option value="{{OrderStatus::SHIPPING}}">{{OrderStatus::SHIPPING}}</option>
                                <option value="{{OrderStatus::DELIVERED}}">{{OrderStatus::DELIVERED}}</option>
                                <option value="{{OrderStatus::CANCELED}}">{{OrderStatus::CANCELED}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        function sumbit(action) {
            $('#exampleModal').modal('show');
            $('#form-changeStatus').attr('action', action);
        }
    </script>
@endsection
