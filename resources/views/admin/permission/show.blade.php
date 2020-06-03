@extends('admin.layouts.master')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="panel">
            <div class="panel-header">
                <h3 class="text-center" style="padding-top: 20px">Information Permission</h3>
                <hr>
            </div>
            <div class="panel-body">
                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('permission.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center text-capitalize">information Permission</h3>
                    </div>
                    <div class="card-body">
                        <span class="font-weight-bold text-capitalize">display name:</span> {{ $permission->display_name }}
                        <hr>
                        <span class="font-weight-bold text-capitalize">slug:</span> {{ $permission->name }}
                        <hr>
                        <span class="font-weight-bold text-capitalize">description:</span> {{ $permission->description }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
