@extends('layouts/master')

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
		Cells
	</h3>

	<div class="table-responsive">
	    <table id="cells-table" class="table table-striped">
	        <thead>
	            <th>No.</th>
	            <th>CELL NAME</th>
				<th>FELLOWSHIP</th>
				<th>LEADER</th>
				<th>ACTIONS</th>
	        </thead>
	        <tbody>
	            @foreach ($cells as $cell)
	            <tr>
	                <td>
	                    {{ $cell->id}}
	                </td>
	                <td>
	                    {{ $cell->name }}
	                </td>
	                <td>
	                    {{ $cell->fellowship->name }}
					</td>
					<td>
						{{ $cell->leader }}
					</td>
					<td>
						<div class="row">
							<a href="{{ route('cells.show', $cell->id)}}" class="ml-2 mr-2">
								<i class="fas fa-eye action-icon"></i>
							</a>
							<a href="{{ route('cells.edit', $cell->id) }}" class="mr-3">
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
			$('#cells-table').DataTable();
		});
        $('.toast').toast(option)
	</script>
@endsection
