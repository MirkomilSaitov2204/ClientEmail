@extends('admin.layouts.master')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="panel">
            @if (count($errors)>0)
                <div class="alert">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel-header">
                <h3 class="text-center" style="padding-top: 20px">
                        {{ isset($user) ? 'Edit User' : 'Create User' }}
                </h3>
                <hr>
            </div>
            <div class="panel-body">
                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <form action="{{ isset($user) ? route('user.update', ['id' => $user->id]) : route('user.store')}} " method="POST" enctype="multipart/form-data">
                   @if (isset($user))
                        @method('PUT')
                   @endif
                    <div class="row">
                        <div class="col-md-7">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control" value="{{ isset($user) ? $user->name : ''  }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" placeholder="Email" class="form-control" value="{{ isset($user) ? $user->email : ''  }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>

                                <select name="roles[]"  id="role" class="form-control ">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}"
                                            @if (isset($user))
                                                @if($user->roles->contains($role->id))
                                                    selected='selected'
                                                @endif
                                          @endif
                                        >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image" placeholder="Image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-outline-info d-flex btn-block justify-content-center"><i class="fa fa-paper-plane"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>
@endsection
