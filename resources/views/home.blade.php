@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as {{ Auth::user()->full_name }} with Email {{ Auth::user()->email }}

                    <div class="row pt-3">
                        <div class="">
                            <p>Your Role(s) : </p>
                        </div>

                        @foreach (Auth::user()->roles as $role)
                           <ul>
                               <li>
                                   {{ $role->name }}
                               </li>
                           </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
