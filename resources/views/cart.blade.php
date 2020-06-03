@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Cart <a href="{{ route('products') }}" class="pull-right btn btn-outline-secondary"><i class="fa fa-user-plus"></i> Back to Products</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach (Cart::content() as $item)
                            <div class="col-md-3 my-3">
                                <div class="card card-bordered">
                                    <div class="card-header">{{ $item->product }}</div>
                                    <div class="card-body">
                                        <div class="card-paragraph">${{ $item->subtotal() }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                </div>
                <div class="cart-footer">
                    <div class="alert alert-success">
                        Total price {{ number_format(Cart::subtotal(), 0) }}
                    </div>
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf
                        <button type="submit" class="thm-btn thm-blue-bg">Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
