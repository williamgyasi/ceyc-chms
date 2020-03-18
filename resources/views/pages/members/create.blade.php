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
        <div class="col-md-6 col-sm-12 offset-md-3">
            <h3 class="mb-2">
                ADD MEMBER    
            </h3>    
            <form action="{{ route('members.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" name="lastname" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" name="firstname" class="form-control form-control-lg required">
                </div>
                <div class="form-group">
                    <label for="">Other Name</label>
                    <input type="text" name="othernames" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="">Mobile Number</label>
                    <input type="text" name="phone" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="">Other Number</label>
                    <input type="text" name="alt_phone" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="">Date of Birth</label>
                    <input type="date" name="dob" class="form-control form-control-lg" id="datepicker" required placeholder="YYYY-MM-DD">
                </div>
                <div class="form-group">
                    <label for="">Gender</label>
                   <div class="form-check">
                       <input type="radio" class="form-check-input" name="gender" value="Male" required>
                       <label for="" class="form-check-label">Male</label><br>
                       <input type="radio" class="form-check-input" name="gender" value="Female" required>
                       <label for="" class="form-check-label">Female</label>
                   </div>
                </div>
                <div class="form-group">
                    <label for="">Residential Address</label>
                    <input type="text" name="residential_address" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="">Digital Address</label>
                    <input type="text" name="digital_address" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="">School</label>
                    <input type="text" name="school" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="">Workplace/Organisation</label>
                    <input type="text" name="work" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="">Fellowship</label>
                    <select name="fellowship_id" id="" class="form-control form-control-lg">
                        <option value="" selected disabled>Select Fellowship</option>
                        @foreach ($fellowships as $fellowship)
                            <option value="{{ $fellowship->id }}">
                                {{ $fellowship->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Department</label>
                    <select name="department_id" id="" class="form-control form-control-lg">
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
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#datepicker').flatpickr({
                // defaultDate: new Date(),
                enableTime: false,
                dateFormat: "Y-m-d"
            });
        });
    </script>
@endsection