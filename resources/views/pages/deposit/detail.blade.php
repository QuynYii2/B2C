@php use App\Enums\DepositStatus; @endphp
@extends('master')

@section('title', 'Chi tiết')

@section('content')
    <div class="card">
        <div class="">
            <h5 class="text-center">Chi tiết</h5>
        </div>
        @if(session('error'))
            <h3 class="text-center text-danger">Error, please try again!</h3>
        @endif
        <form method="post" action="{{route('deposit.update', $deposit->id)}}">
            @csrf
            <div class="form-group">
                <label for="address_from">ADDRESS FROM</label>
                <select id="address_from" name="address_from" class="form-control">
                    @if($deposit->address_from == 'vi')
                        <option value="vi">Viet Nam</option>
                        <option value="kr">Korea</option>
                        <option value="cn">China</option>
                        <option value="jp">Japan</option>
                    @elseif($deposit->address_from == 'kr')
                        <option value="kr">Korea</option>
                        <option value="vi">Viet Nam</option>
                        <option value="cn">China</option>
                        <option value="jp">Japan</option>
                    @elseif($deposit->address_from == 'cn')
                        <option value="cn">China</option>
                        <option value="kr">Korea</option>
                        <option value="vi">Viet Nam</option>
                        <option value="jp">Japan</option>
                    @else
                        <option value="jp">Japan</option>
                        <option value="kr">Korea</option>
                        <option value="vi">Viet Nam</option>
                        <option value="cn">China</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="address_to">ADDRESS TO</label>
                <select id="address_to" name="address_to" class="form-control">
                    @if($deposit->address_to == 'vi')
                        <option value="vi">Viet Nam</option>
                        <option value="kr">Korea</option>
                        <option value="cn">China</option>
                        <option value="jp">Japan</option>
                    @elseif($deposit->address_to == 'kr')
                        <option value="kr">Korea</option>
                        <option value="vi">Viet Nam</option>
                        <option value="cn">China</option>
                        <option value="jp">Japan</option>
                    @elseif($deposit->address_to == 'cn')
                        <option value="cn">China</option>
                        <option value="kr">Korea</option>
                        <option value="vi">Viet Nam</option>
                        <option value="jp">Japan</option>
                    @else
                        <option value="jp">Japan</option>
                        <option value="kr">Korea</option>
                        <option value="vi">Viet Nam</option>
                        <option value="cn">China</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="distance">DISTANCE</label>
                <input min="1" type="number" class="form-control" id="distance" name="distance" placeholder="Enter number"
                       value="{{$deposit->distance}}" required>
            </div>
            <div class="form-group">
                <label for="price_percent">PRICE PERCENT</label>
                <input min="50" max="100"  type="number" class="form-control" id="price_percent" name="price_percent"
                       placeholder="Enter number"
                       value="{{$deposit->price_percent}}" required>
            </div>
            <div class="form-group">
                <label for="shipping_fee">SHIPPING FEE</label>
                <input min="10"  type="text" class="form-control" id="shipping_fee" name="shipping_fee" placeholder="Enter number"
                       value="{{$deposit->shipping_fee}}" required>
            </div>
            <div class="form-group">
                <label for="tax_percent">TAX PERCENT</label>
                <input min="5" max="35"  type="number" class="form-control" id="tax_percent" name="tax_percent" placeholder="Enter phone"
                       value="{{$deposit->tax_percent}}" required>
            </div>
            <div class="form-group">
                <label for="weight">WEIGHT</label>
                <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter weight"
                       value="{{$deposit->weight}}" required>
            </div>
            <div class="form-group">
                <label for="description">DESCRIPTION</label>
                <input type="text" class="form-control" id="description" name="description"
                       placeholder="Enter description"
                       value="{{$deposit->description}}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control">
                    @if($deposit->status == DepositStatus::ACTIVE)
                        <option value="{{DepositStatus::ACTIVE}}">ACTIVE</option>
                        <option value="{{DepositStatus::INACTIVE}}">INACTIVE</option>
                    @else
                        <option value="{{DepositStatus::INACTIVE}}">INACTIVE</option>
                        <option value="{{DepositStatus::ACTIVE}}">ACTIVE</option>
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

