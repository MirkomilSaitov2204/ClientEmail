@extends('admin.layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="panel">
            <div class="panel-header">
                <h3 class="text-center" style="padding-top: 20px">Send Info</h3>
                <hr>
            </div>
            <div class="panel-body">
                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="text-center text-capitalize">information User</h3>
                    </div>
                    <div class="card-body">
                        <span class="font-weight-bold text-capitalize">username:</span> {{ $order->user->name }}
                        <hr>
                        <span class="font-weight-bold text-capitalize">Email:</span> {{ $order->user->email }}
                        <hr>
                        <span class="font-weight-bold text-capitalize">Phone:</span> {{ $order->user->phone }}
                        <hr>

                        <ul class="list-group">
                            <span class="font-weight-bold text-capitalize"> Ordered Product:</span>
                            @foreach ($products as $role)
                                <li class="list-group-item">{{ $role->product }}  <em class="m-l-15">$ {{ number_format($role->cost, 0) }}</em></li>

                            @endforeach
                        </ul>
                        <hr>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">
                            <h3 class="text-center text-capitalize">Send data to User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.send') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $order->user->id }}">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Your name">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-block btn btn-success">Send By Email</button>
                                <hr>
                            </div>
                        </form>
                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                <!-- Button -->
                                <button class="btn btn-block btn-info flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Send By SMS
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('vendor/lightbox2/js/lightbox.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal({
                        title: "SMS Not Send",
                        text: "You can not send sms to user phone because of playmobile is not free.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }).then(function() {
                        /* do stuff */
                    })
			});
		});
	</script>

@endsection
