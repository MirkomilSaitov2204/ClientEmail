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
                        {{ isset($permission) ? 'Edit Permission' : 'Create Permission' }}
                </h3>
                <hr>
            </div>
            <div class="panel-body">
                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('permission.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <form action="{{ isset($permission) ? route('permission.update', ['id' => $permission->id]) : route('permission.store')}} " method="POST">
                   @if (isset($permission))
                        @method('PUT')
                   @endif
                    <div class="row">
                        <div class="col-md-7">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="display_name">Name (Display Name)</label>
                                {{-- <input type="text" id="dd" > --}}
                                <input type="text" id="display_name" name="display_name" placeholder="Name" class="form-control" value="{{ isset($permission) ? $permission->display_name : ''  }}">
                            </div>
                            <div class="form-group">
                                <label for="option">Resource</label>
                                <select id="option" class="form-control" name="option"  selected value>
                                        <option selected disabled >Choose</option>
                                    <option value="1">Create</option>
                                    <option value="2">Read</option>
                                    <option value="3">Update</option>
                                    <option value="4">Delete</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Slug*</label>
                                <input type="text" id="name" name="name" class="form-control"  value="{{ isset($permission) ? $permission->name : ''  }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="image">Show</label>
                                <input type="text"  name="description" id="description" readonly class="form-control" value="{{ isset($permission) ? $permission->description : ''  }}">
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
    var Text='';
    var selectedVal='';

    $("#display_name").keyup(function(){
        Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#description").val('Allow to User to '+selectedVal +' a '+ Text);
        $("#name").val(Text+'-'+selectedVal);
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
