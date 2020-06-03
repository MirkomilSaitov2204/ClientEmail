@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Product List</div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($products as $item)
                            <div class="col-md-3 my-3">
                                <div class="card card-bordered">
                                    <div class="card-header">{{ $item->product }}</div>
                                    <div class="card-body">
                                        <div class="card-paragraph">{{ $item->presentPrice() }}</div>
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="product" value="{{ $item->product }}">
                                            <input type="hidden" name="cost" value="{{ $item->cost }}">
                                            <button type="submit" class="btn btn-success">+Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
