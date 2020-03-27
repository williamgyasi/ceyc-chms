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
                Assign Role To User
            </h3>
            <form action="{{ route('user.roles.assign-role') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">
                        User
                    </label>
                    <select name="user_id" id="" class="form-control select2">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->full_name }} - {{ $user->fellowship_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">
                        Assign Role
                    </label>
                    <select name="role_id" id="" class="custom-select">
                        <option value="" selected disabled>
                            Select A Role
                        </option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}
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
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
