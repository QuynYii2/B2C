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

@section('title', 'Thống kê doanh thu')

@section('content')
    <div class="card">
        <div class="">
            <h5 class="text-center">
                Thống kê doanh thu
            </h5>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filter</h5>
                <form class="row g-3" method="post" action="{{route('statistic.revenue')}}">
                    @csrf
                    <div class="col-md-3">
                        <label for="start_datetime" class="form-label">Start Date: </label>
                        <input type="date" class="form-control" id="start_datetime" name="start_date">
                    </div>
                    <div class="col-md-3">
                        <label for="end_datetime" class="form-label">End Date: </label>
                        <input type="date" class="form-control" id="end_datetime" name="end_date">
                    </div>
                    <div class="col-md-3">
                        <label for="statistic_revenue" class="form-label">Revenues: </label>
                        <select name="statistic_revenue" id="statistic_revenue" class="form-control">
                            <option value="high">From low to high</option>
                            <option value="low">From high to low</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                        <button class="btn btn-danger" style="margin: 8px 16px "><a
                                href="{{route('statistic.list.revenue')}}">Reset</a></button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User ID</th>
                <th scope="col">Statistic Revenue</th>
                <th scope="col">Datetime</th>
                <th scope="col">Country</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($statistics == null)
                No Statistic
            @else
                @foreach($statistics as $item)
                    <tr>
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>{{$item->user_id}}</td>
                        <td>{{$item->total_income}}</td>
                        <td>{{$item->datetime}}</td>
                        <td>{{$item->country}}</td>
                        <td>{{$item->status}}</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary">
                                    <a href="#">Chi tiết</a>
                                </button>
                                <button type="button"
                                        class="btn btn-primary">
                                    Sửa trạng thái
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
