@extends('admin.layouts.master')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="panel">
            <div class="panel-header">
                <h3 class="text-center" style="padding-top: 20px">Role List</h3>
                <hr>

            </div>
            <div class="panel-body">
                    <div class="d-flex justify-content-end mb-5">
                        <a href="{{ route('role.create') }}" class="btn btn-outline-secondary"><i class="fa fa-user-plus"></i> Create Role</a>
                    </div>
                    <div class="col-md-12">
                        <table id="table" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Display Name</th>
                                        <th>slug</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $k=>$role)
                                        <tr>
                                            <td>{{ ++$k }}</td>
                                            <td>{{ $role->display_name }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>
                                                <a href="{{ route('role.show', ['id' => $role->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('role.edit', ['id' => $role->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>№</th>
                                        <th>Display Name</th>
                                        <th>slug</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                    </div>
            </div>
        </div>
    </section>
</section>
@endsection
