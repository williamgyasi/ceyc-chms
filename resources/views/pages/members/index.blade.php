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
            Members
        </h3>

        <div class="table-responsive">
            <table id="members-table" class="table table-striped">
                <thead>
                    <tr role="row">
                        <th>No.</th>
                        <th>NAME</th>
                        <th>OTHER NAMES</th>
                        <th>PHONE NUMBER</th>
                        {{-- <th>ALT. NUMBER</th> --}}
                        <th>EMAIL</th>
                        <th>DoB</th>
                        <th>FELLOWSHIP</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>
                                {{ $member->id }}
                            </td>
                            <td>
                                {{ $member->fullname }}
                            </td>
                            <td>
                                {{ $member->othernames ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $member->phone }}
                            </td>
                            {{-- <td>
                                {{ $member->alt_phone  ?? 'N/A' }}
                            </td> --}}
                            <td>
                                {{ $member->email }}
                            </td>
                            <td>
                                {{ $member->dob->format('d-M-Y') }}
                            </td>
                            <td>
                                {{ $member->fellowship->name }}
                            </td>
                            <td>
                                <div class="row justify-content-center">
                                    <a href="{{ route('members.show', $member->id)}}" class="mr-1">
                                        <i class="fas fa-eye action-icon"></i>
                                    </a>
                                    <a href="{{ route('members.edit', $member->id) }}" class="">
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
			$('#members-table').DataTable();
		});
	</script>
@endsection