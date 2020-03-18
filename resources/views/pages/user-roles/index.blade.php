@extends('layouts.master')

@section('content')
<div class="container">
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
        Users and Roles
    </h3>

    <div class="table-responsive">
        <table id="users-roles-table" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>USER</th>
                    <th>ROLES</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->full_name }}
                        </td>
                        <td>
                            @if ($user->roles->count() > 0)
                                @foreach ($user->roles as $roles)
                                    {{ $roles->name }}
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>
                        <td></td>
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
			$('#users-roles-table').DataTable();
		});
	</script>
@endsection