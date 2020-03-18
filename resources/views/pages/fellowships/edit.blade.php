@extends('layouts.master')

@section('content')

<div class="container">

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

    <div class="col-md-6 col-sm-12 offset-md-3">

        <h3 class="mb-2">
            Edit Fellowship
        </h3>

        <form action="{{ route('fellowships.update' , $fellowship->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Fellowship Name</label>
                <input name="name" type="text" value="{{ $fellowship->name }}" class="form-control form-control-lg" required>
            </div>
            <div class="form-group">
                <label for="">Leader</label>
                <select name="leader" id="" class="form-control form-control-lg">
                    <option value="{{ $fellowship->leader }}" selected>{{ $fellowship->leader }}</option>
                    @foreach ($members as $member)
                    <option value="{{ $member->full_name }}">
                        {{ $member->full_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary btn-block">SAVE</button>
        </form>

    </div>

</div>
@endsection