@extends('master')

@section('title', 'Danh sách kho hàng')

@section('content')
    <div class="card">
        <div class="row">
            <div class="">
                <h5 class="text-center">Danh sách kho hàng</h5>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($warehouses as $warehouse)
                    <tr>
                        <th scope="row"> {{ $loop->index + 1 }}</th>
                        <td>
                            <a href="{{route('warehouse.detail', $warehouse->id)}}">
                                {{$warehouse->name}}
                            </a>
                        </td>
                        <td>{{$warehouse->phone}}</td>
                        <td>{{$warehouse->email}}</td>
                        <td>{{$warehouse->address}}</td>
                        <td>{{$warehouse->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

