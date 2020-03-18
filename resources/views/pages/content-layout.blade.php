<!-- Description -->
@extends('layouts/master')

<div hidden>
    @section('title', 'Admin Dashboard')
</div>

@section('content')

<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Content Layout</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="card-text">
                <p>Your content goes here</p>
            </div>
            <div class="table-responsive">
                <table id="test-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Demo</th>
                            <th>Demo</th>
                            <th>Demo</th>
                            <th>Demo</th>
                            <th>Demo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                        </tr>
                        <tr>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                        </tr>
                        <tr>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                            <td>test for tables</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--/ Description -->
@endsection


@section('scripts')
	<script>
		$(document).ready(function () {
			$('#test-table').DataTable();
		});
	</script>
@endsection