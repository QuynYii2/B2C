
@extends('master')

@section('title', 'Thống kê lượt huỷ đơn hàng')

@section('content')
    <div class="card">
        <div class="">
            <h5 class="text-center">
                Thống kê lượt huỷ đơn hàng
            </h5>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filter</h5>
                <form class="row g-3" method="post" action="{{route('statistic.cancel')}}">
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
                        <label for="numbers" class="form-label">Numbers: </label>
                        <select name="numbers" id="numbers" class="form-control">
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
                <th scope="col">Numbers</th>
                <th scope="col">Datetime</th>
                <th scope="col">Country</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($statistics == null)
                No statistic
            @else
                @foreach($statistics as $item)
                    <tr>
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>{{$item->user_id}}</td>
                        <td>{{$item->numbers}}</td>
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
