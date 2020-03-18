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
            New Cell
        </h3>
        <form action="{{ route('cells.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="floating-label1">Cell Name</label>
                <input name="name" type="text" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="">Cell's Fellowship</label>
                <select name="fellowship_id" class="form-control form-control-lg">
                    <option value="" selected disabled>Select A Fellowship</option>
                    @foreach ($fellowships as $fellowship)
                    <option value="{{ $fellowship->id }}">
                        {{ $fellowship->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Leader</label>
                <select name="leader" id="" class="form-control form-control-lg">
                    <option value="" selected disabled>Select A Leader</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->full_name }}">
                            {{ $member->full_name }} - {{ $member->fellowship->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary btn-block">SAVE</button>
        </form>
    </div>
</div>
@endsection
