@extends('layouts.master')

@section('content')

<div class="container mb-5">

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="col-md-6 col-sm-12 offset-3">

        <h3 class="mb-2">
            New User Roles
        </h3>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Role Name</label>
                <input type="text" name="name" class="form-control form-control-lg">
            </div>

            <button class="btn btn-primary btn-block">SAVE</button>
        </form>
    </div>

</div>
@endsection