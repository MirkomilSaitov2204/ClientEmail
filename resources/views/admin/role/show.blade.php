@extends('admin.layouts.master')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="panel">
            <div class="panel-header">
                <h3 class="text-center" style="padding-top: 20px">Information Role</h3>
                <hr>
            </div>
            <div class="panel-body">
                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('role.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center text-capitalize">information Role</h3>
                    </div>
                    <div class="card-body">
                        <span class="font-weight-bold text-capitalize">display name:</span> {{ $role->display_name }}
                        <hr>
                        <span class="font-weight-bold text-capitalize">slug:</span> {{ $role->name }}
                        <hr>
                        <span class="font-weight-bold text-capitalize">description:</span> {{ $role->description }}
                        <hr>
                        <span class="font-weight-bold text-capitalize">permission:</span>
                        <ul class="list-group">
                            @foreach ($role->permissions as $permission)
                                <li class="list-group-item"> {{ $permission->display_name }}  <em class="m-l-15">({{ $permission->description }})</em></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
