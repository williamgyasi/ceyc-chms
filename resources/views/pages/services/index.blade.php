@extends('layouts.master')

@section('content')
    
<div class="container-mb-2">

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
        Services
    </h3>

    <div class="table-responsive">
        <table id="services-table" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>SERVICE</th>
                    <th>STARTS</th>
                    <th>ENDS</th>
                    <th>PASTORIAL ASSISTANT</th>
                    <th>SERVICE ADMINISTRATOR</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>
                            {{ $service->id }}
                        </td>
                        <td>
                            {{ $service->service_name }}
                        </td>
                        <td>
                            {{ $service->start_time }}
                        </td>
                        <td>
                            {{ $service->end_time}}
                        </td>
                        <td>
                            {{ $service->pastorial_assistant }}
                        </td>
                        <td>
                            {{ $service->service_admin}}
                        </td>
                        <td>
                            <div class="row">
                                <a href="{{ route('services.show', $service->id)}}" class="ml-2 mr-2">
                                    <i class="fas fa-eye action-icon"></i>
                                </a>
                                <a href="{{ route('services.edit', $service->id) }}" class="mr-3">
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
			$('#services-table').DataTable();
		});
	</script>
@endsection