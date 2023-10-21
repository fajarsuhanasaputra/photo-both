@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Voucher') }}</div>

                <div class="card-body">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="col-md-6 form-group">
                            <label for="coupon">{{ __('I have Coupon') }}</label>
                            <input type="text" name="code" id="coupon_code">
                            <button type="submit">Apply</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
