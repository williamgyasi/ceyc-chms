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
        Fellowships
    </h3>

    <div class="table-responsive">
        <table id="fellowships-table" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NAME</th>
                    <th>LEADER</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fellowships as $fellowship)
                <tr>
                    <td>
                        {{ $fellowship->id }}
                    </td>
                    <td>
                        {{ $fellowship->name }}
                    </td>
                    <td>
                        {{ $fellowship->leader ?? 'N/A' }}
                    </td>
                    <td>
                        <div class="row">
                             <a href="{{ route('fellowships.show', $fellowship->id)}}" class="ml-2 mr-2">
                                 <i class="fas fa-eye action-icon"></i>
                             </a>
                             <a href="{{ route('fellowships.edit', $fellowship->id) }}" class="mr-3">
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
			$('#fellowships-table').DataTable();
		});
	</script>
@endsection