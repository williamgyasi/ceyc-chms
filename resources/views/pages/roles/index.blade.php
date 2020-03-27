@extends('layouts.master')

@section('content')

<div class="container mb-2">

    <div class="container">
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
        @endif
    </div>

    <h3 class="mb-2">
        Roles
    </h3>

    <div class="table-responsive">
        <table id="roles-table" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NAME</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $role->name }}
                        </td>
                        <td>
                            <div class="row">
                                <a href="{{ route('roles.show', $role->id)}}" class="ml-2 mr-2">
                                    <i class="fas fa-eye action-icon"></i>
                                </a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="mr-3">
                                    <i class="fas fa-edit action-icon"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function () {
			$('#roles-table').DataTable();
		});
	</script>
@endsection
