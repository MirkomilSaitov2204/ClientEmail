@extends('admin.layouts.master')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="panel">
            <div class="panel-header">
                <h3 class="text-center" style="padding-top: 20px">Information User</h3>
                <hr>
            </div>
            <div class="panel-body">
                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="text-center text-capitalize">information User</h3>
                        <img src="/storage/userImage/{{ $user->image }}" alt="" width="60px" height="60px" style="border-radius:50%">
                    </div>
                    <div class="card-body">
                        <span class="font-weight-bold text-capitalize">username:</span> {{ $user->name }}
                        <hr>
                        <span class="font-weight-bold text-capitalize">Email:</span> {{ $user->email }}
                        <hr>
                        <ul class="list-inline">
                            <span class="font-weight-bold text-capitalize"> Role:</span>
                            @foreach ($user->roles as $role)
                                <li class="list-inline-item">{{ $role->name }}  <em class="m-l-15">({{ $role->description }})</em></li>
                            @endforeach
                        </ul>
                        <hr>
                        <ul class="list-group">
                            <span class="font-weight-bold text-capitalize"> Permission:</span>
                            @if ($role->permissions)
                                @foreach ($role->permissions as $permission)
                                    <li class="list-group-item">{{ $permission->name }}  <em class="m-l-15">({{ $permission->description }})</em></li>
                                @endforeach
                            @endif
                        </ul>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
