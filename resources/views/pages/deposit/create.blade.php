@php use App\Enums\DepositStatus; @endphp
@extends('master')

@section('title', 'Create deposit')

@section('content')
    <div class="card">
        <div class="">
            <h5 class="text-center">Create deposit</h5>
        </div>
        @if(session('error'))
            <h3 class="text-center text-danger">Error, please try again!</h3>
        @endif
        <form method="post" action="{{route('deposit.create')}}">
            @csrf
            <div class="form-group">
                <label for="address_from">ADDRESS FROM</label>
                <select id="address_from" name="address_from" class="form-control">
                    <option value="cn">China</option>
                    <option value="vi">Viet Nam</option>
                    <option value="kr">Korea</option>
                    <option value="jp">Japan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address_to">ADDRESS TO</label>
                <select id="address_to" name="address_to" class="form-control">
                    <option value="vi">Viet Nam</option>
                    <option value="kr">Korea</option>
                    <option value="cn">China</option>
                    <option value="jp">Japan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="distance">DISTANCE</label>
                <input type="text" class="form-control" id="distance" name="distance" placeholder="Enter distance"
                       required>
            </div>
            <div class="form-group">
                <label for="price_percent">PRICE PERCENT</label>
                <input type="number" class="form-control" id="price_percent" name="price_percent"
                       placeholder="Enter price percent" required>
            </div>
            <div class="form-group">
                <label for="shipping_fee">SHIPPING FEE</label>
                <input type="text" class="form-control" id="shipping_fee" name="shipping_fee" placeholder="Enter shipping fee"
                       required>
            </div>
            <div class="form-group">
                <label for="tax_percent">TAX PERCENT</label>
                <input type="number" class="form-control" id="tax_percent" name="tax_percent" placeholder="Enter tax percent"
                       required>
            </div>
            <div class="form-group">
                <label for="weight">WEIGHT</label>
                <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter weight" required>
            </div>
            <div class="form-group">
                <label for="description">DESCRIPTION</label>
                <input type="text" class="form-control" id="description" name="description"
                       placeholder="Enter description">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="{{DepositStatus::ACTIVE}}">ACTIVE</option>
                    <option value="{{DepositStatus::INACTIVE}}">INACTIVE</option>
                </select>
            </div>
            <div class="form-group">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
