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
                        {{ isset($role) ? 'Edit Role' : 'Create Role' }}
                </h3>
                <hr>
            </div>
            <div class="panel-body">
                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('role.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <form action="{{ isset($role) ? route('role.update', ['id' => $role->id]) : route('role.store')}} " method="POST">
                   @if (isset($role))
                        @method('PUT')
                    @endif
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="display_name">Name (Display Name)</label>
                                {{-- <input type="text" id="dd" > --}}
                                <input type="text" id="display_name" name="display_name" placeholder="Name" class="form-control" value="{{ isset($role) ? $role->display_name : ''  }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Slug*</label>
                                <input type="text" id="name" name="name" class="form-control"  value="{{ isset($role) ? $role->name : ''  }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="image">Description</label>
                                <textarea name="description" id="description" cols="30" rows="8" class="form-control">{{ isset($role) ? $role->description : ''  }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="card">
                                <div class="card-header"><label>Permission</label></div>
                                <div class="card-body">
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input class="" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_id"
                                                  @if (isset($role))
                                                    @if($role->permissions->contains($permission->id))
                                                        checked='checked'
                                                    @endif
                                                  @endif
                                                >
                                            <label class="" for="permission_id">{{ $permission->name }}  <em class="ml-2" style="font-weight: 300; font-size: 0.9rem">  ({{ $permission->description }})</em></label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-info d-flex btn-block justify-content-center"><i class="fa fa-paper-plane"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>

<script>
    var Text;
var selectedVal;

// if ($("#display_name").is(":keyup")) {

// }
    $("#display_name").keyup(function(){
                Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
                $("#name").val(Text);

            });

    $("#option").change(function() {
        selectedVal = $("#option option:selected").text();
        selectedVal = selectedVal.toLowerCase();
        selectedVal = selectedVal.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#description").val('Allow to User to '+selectedVal +' a '+ Text);
        $("#name").val(Text+'-'+selectedVal);
    });

</script>
@endsection
