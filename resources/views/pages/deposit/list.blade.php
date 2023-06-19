@extends('master')

@section('title', 'Danh sách')

@section('content')
    <div class="card">
        <div class="">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="">Danh sách</h5>
                <a href="{{route('deposit.processCreate')}}" class="btn btn-warning">Create deposit</a>
            </div>
            @if(session('message'))
                <h3 class="text-center text-success">Success!</h3>
            @endif
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Address From</th>
                    <th scope="col">Address To</th>
                    <th scope="col">Price Percent</th>
                    <th scope="col">Shipping Fee</th>
                    <th scope="col">Tax Percent</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deposits as $deposit)
                    <tr>
                        <th scope="row"> {{ $loop->index + 1 }}</th>
                        <td>
                            @if($deposit->address_from == 'kr')
                                Korea
                            @elseif($deposit->address_from == 'jp')
                                Japan
                            @elseif($deposit->address_from == 'cn')
                                China
                            @else
                                VietNam
                            @endif
                        </td>
                        <td>
                            @if($deposit->address_to == 'kr')
                                Korea
                            @elseif($deposit->address_to == 'jp')
                                Japan
                            @elseif($deposit->address_to == 'cn')
                                China
                            @else
                                VietNam
                            @endif
                        </td>
                        <td>{{$deposit->price_percent}}<span>%</span></td>
                        <td><span>Default:</span> <span>$</span>{{$deposit->shipping_fee}} </td>
                        <td>{{$deposit->tax_percent}}<span>%</span></td>
                        <td>{{$deposit->status}}</td>
                        <td>
                            <div class="">
                                <a href="{{route('deposit.detail', $deposit->id)}}" class="btn btn-success">Chi tiết</a>
                                <form action="{{route('deposit.delete', $deposit->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

