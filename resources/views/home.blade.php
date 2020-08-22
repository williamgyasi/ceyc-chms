@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Howdy!
                    </h4>
                </div>

                <div class="card-body">
                    <p>
                        You logged in as {{ auth()->user()->full_name }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
