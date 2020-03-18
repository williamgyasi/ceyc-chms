@extends('layouts.master')

@section('content')

<div class="container mb-2">

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
            New Service
        </h3>

        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Service Name</label>
                <input type="text" name="name" class="form-control form-control-lg" required>
            </div>
            <div class="form-group">
                <label for="">Start Time</label>
                <input  type="time" name="start_time" class="form-control form-control-lg" id="start_time">
            </div>
            <div class="form-group">
                <label for="">End Time</label>
                <input type="text" name="end_time" class="form-control form-control-lg" id="end_time">
            </div>
            <div class="form-group">
                <label for="">Pastorial Assistant</label>
                {{-- <input type="text" name="pastorial_assistant" class="form-control form-control-lg" required> --}}
                <select name="pastorial_assistant"class="form-control  form-control-lg select" required>
                    <option value="" selected disabled>Select A Pastorial Assistant</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->full_name }}">
                            {{ $user->full_name }} | {{ $user->fellowship->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Administrative Assistant</label>
                {{-- <input type="text" name="service_admin" class="form-control form-control-lg" required> --}}
                <select name="service_admin" id="" class="form-control  form-control-lg select" required>
                    <option value="" selected disabled>Select An Administrative Assistant</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->full_name }}">
                            {{ $user->full_name }} | {{ $user->fellowship->name }}
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
        $('#start_time').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        $('#end_time').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    });
</script>
@endsection