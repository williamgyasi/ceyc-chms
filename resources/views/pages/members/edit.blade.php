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
            Edit {{ $member->full_name }}'s Details.
        </h3>
        <form action="{{ route('members.update' , $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="lastname" value="{{ $member->lastname }}" class="form-control form-control-lg" required>
            </div>
            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="firstname" value="{{ $member->firstname }}" class="form-control form-control-lg required">
            </div>
            <div class="form-group">
                <label for="">Other Name</label>
                <input type="text" name="othernames" value="{{ $member->othernames }}" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="">Mobile Number</label>
                <input type="text" name="phone" value="{{ $member->phone }}" class="form-control form-control-lg" required>
            </div>
            <div class="form-group">
                <label for="">Other Number</label>
                <input type="text" name="alt_phone" value="{{ $member->alt_phone }}" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" value="{{ $member->email }}" class="form-control form-control-lg" required>
            </div>
            <div class="form-group">
                <label for="">Date of Birth</label>
                <input type="text" name="dob" value="{{ $member->dob->format('Y-M-d') }}" class="form-control form-control-lg" id="datepicker" required
                    placeholder="YYYY-MM-DD">
            </div>
            <div class="form-group">
                <label for="">Gender</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="gender" value="Male" {{ ($member->gender === 'Male') ? "checked" : " "}} required>
                    <label for="" class="form-check-label">Male</label><br>
                    <input type="radio" class="form-check-input" name="gender" value="Female" {{ ($member->gender === 'Female') ? "checked" : " "}} required>
                    <label for="" class="form-check-label">Female</label>
                </div>
            </div>
            <div class="form-group">
                <label for="">Residential Address</label>
                <input type="text" name="residential_address"  value="{{ $member->residential_address }}" class="form-control form-control-lg" required>
            </div>
            <div class="form-group">
                <label for="">Digital Address</label>
                <input type="text" name="digital_address" value="{{ $member->digital_address }}" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="">School</label>
                <input type="text" name="school" value="{{ $member->school }}" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="">Workplace/Organisation</label>
                <input type="text" name="work" value="{{ $member->work }}" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="">Fellowship</label>
                <select name="fellowship_id" id="" class="form-control form-control-lg">
                    <option value="{{ $member->fellowship->id }}" selected>{{ $member->fellowship->name }}</option>
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
                    @if (empty($member->department->id))
                        <option value="" selected disabled>
                            Select A Department
                        </option>
                    @else
                        <option value="{{ $member->department->id }}" selected>
                            {{ $member->department->name }}
                        </option>
                    @endif
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
            enableTime: false,
            dateFormat: "Y-m-d"
        });
    });
</script>
@endsection