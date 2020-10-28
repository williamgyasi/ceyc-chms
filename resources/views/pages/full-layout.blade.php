<!-- Description -->
@extends('layouts/fullLayoutMaster')

@section('title', 'Full Layout')

@section('pageStyle')

    <link rel="stylesheet" href="{{ asset(mix('css/pages/authentication.css')) }}">

@endsection

@section('content')

<section class="row flexbox-container">
    <div class="col-xl-8 col-10 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                    <img src="{{ asset('/images/pages/register.jpg') }}" alt="branding-logo">
                </div>
                <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 p-2">
                        <div class="card-header pt-50 pb-1">
                            <div class="card-title">
                                <h4 class="mb-0">Create Account</h4>
                            </div>
                        </div>
                        <p class="px-2">Fill the below form to create a new account.</p>
                        <div class="card-content">
                            <div class="alert alert-danger" role="alert">
                              <p class="mb-0">
                                    @if ($errors->any())
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>
                                                    {{ $error }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </p>
                            </div>
                            <div class="card-body pt-0">
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-label-group">
                                        <input type="text" id="inputName" name="firstname" class="form-control" placeholder="First Name" required>
                                        <label for="inputName">First Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" required>
                                        <label for="lastname">Last Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required>
                                        <label for="inputEmail">Email</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" id="inputConfPassword" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                        <label for="inputConfPassword">Confirm Password</label>
                                    </div>
                                    <a href="/" class="btn btn-outline-primary float-left btn-inline mb-50">Back</a>
                                    <button type="submit" class="btn btn-primary float-right btn-inline
                                    mb-50">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ HTML Markup -->

@endsection
