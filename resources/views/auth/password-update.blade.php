@extends('layouts/fullLayoutMaster')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        {{ __('Let\'s Get You A Nice Password') }}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @include('layouts.flash-messages._error')
                            <div class="form-group">
                                <label for="">
                                    Password
                                </label>
                                <input type="password" name="password" class="form-control" id="password-field">
                            </div>
                            <button class="btn btn-primary">SET PASSWORD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection