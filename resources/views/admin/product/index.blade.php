@extends('admin.layouts.master')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="panel">
            <div class="panel-header">
                <h3 class="text-center" style="padding-top: 20px">Order Lists</h3>
                <hr>

            </div>
            <div class="panel-body">
                    <div class="col-md-12">
                        <table id="table" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $k=>$user)
                                        <tr>
                                            <td>{{ ++$k }}</td>
                                            <td>{{ $user->user->name }}</td>
                                            <td>{{ $user->user->email }}</td>
                                            <td>{{ $user->user->phone }}</td>

                                            <td>
                                                @can('read-users')
                                                    <a href="{{ route('products.show', ['id' => $user->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('update-users')
                                                    <a href="{{ route('products.edit', ['id' => $user->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                                                @endcan
                                                @can('delete-users')
                                                    @foreach ($user->roles as $role)
                                                        @if ($role->name !== 'administrator')
                                                            <form action="{{ route('products.destroy', ['id'=>$user->id]) }}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button  type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        @endif
                                                    @endforeach

                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>№</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
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
