@extends('layouts.no-sidebar-master')

@include('panels/register')

<div class="jumbotron text-center">
    <div class="pb-1">
        <h1 class="display-4 animated fadeIn delay-1s">CEYC AIRPORT-CITY</h1>
        <h2>
            MEMBERSHIP PORTAL
        </h2>
    </div>
    <span class="animated fadeIn delay-1s slogans">
        ILLUMINATION | LEADERSHIP | EMPOWERMENT | SIGNS & SEASONS
    </span>
</div>

@section('content')

<div class="container mb-4">

    <div class="row">
        <div class="col-md-6 col-sm-12 offset-md-2">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h3 class="text-center pb-1">
                Fill the form below to register.
            </h3>

            <p class="text-center pb-1">
                All fields mark with <span class="asterisks">*</span> are required fields
            </p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">
                        <span class="asterisks">*</span>
                        Last Name
                    </label>
                    <input type="text" name="lastname" class="form-control" required>
                    @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">
                        <span class="asterisks">*</span>
                        First Name
                    </label>
                    <input type="text" name="firstname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Other Name</label>
                    <input type="text" name="othernames" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">
                        <span class="asterisks">*</span>
                        Mobile Number
                    </label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Other Number</label>
                    <input type="text" name="alt_phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">
                        <span class="asterisks">*</span>
                        Email
                    </label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">
                        <span class="asterisks">*</span>
                        Date of Birth
                    </label>
                    <input type="date" name="dob" class="form-control" id="datepicker" required
                        placeholder="YYYY-MM-DD">
                </div>
                <div class="form-group">
                    <label for="">
                        <span class="asterisks">*</span>
                        Gender
                    </label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="male" name="gender" value="Male" required>
                        <label for="male" class="form-check-label">Male</label><br>
                        <input type="radio" class="form-check-input" id="female" name="gender" value="Female" required>
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><span class="asterisks">*</span>Residential Address</label>
                    <input type="text" name="residential_address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Digital Address</label>
                    <input type="text" name="digital_address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">School</label>
                    <input type="text" name="school" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Workplace/Organisation</label>
                    <input type="text" name="work" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">
                        <span class="asterisks">*</span>
                        Fellowship
                    </label>
                    <select name="fellowship_id" id="" class="custom-select" required>
                        <option value="" selected disabled>
                            Select Fellowship
                        </option>
                        @foreach ($fellowships as $fellowship)
                        <option value="{{ $fellowship->id }}">
                            {{ $fellowship->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Department</label>
                    <select name="department_id" id="" class="custom-select">
                        <option value="" selected disabled>Select Department</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}">
                            {{ $department->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary btn-block">SAVE</button>
            </form>
        </div>

    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#datepicker').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d"
            });
        });
    </script>
@endsection
