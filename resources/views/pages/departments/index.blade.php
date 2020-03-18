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
        Departments
    </h3>

    <div class="table-responsive">
        <table id="departments-table" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NAME</th>
                    <th>LEADER</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                <tr>
                    <td>
                        {{ $department->id }}
                    </td>
                    <td>
                        {{ $department->name }}
                    </td>
                    <td>
                        {{ $department->leader ?? 'N/A' }}
                    </td>
                    <td>
                        <div class="row">
                             <a href="{{ route('departments.show', $department->id)}}" class="ml-2 mr-2">
                                 <i class="fas fa-eye action-icon"></i>
                             </a>
                             <a href="{{ route('departments.edit', $department->id) }}" class="mr-3">
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
			$('#departments-table').DataTable();
		});
	</script>
@endsection