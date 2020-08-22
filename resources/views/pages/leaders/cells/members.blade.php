@extends('layouts.master')

@section('content')
    <div class="container mb-5">
        <div class="row mb-2 mt-2">
            <h4 class="mb-2 font-weight-bold">
                {{ $cell->name }} Cell - Members
            </h4>
        </div>
    </div>

    <div class="table-responsive">
        <table id="members-table" class="table">
            <thead>
            <tr>
                <th>No.</th>
                <th>NAME</th>
                <th>DATE OF BIRTH</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
                <th>ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $member->full_name }}
                    </td>
                    <td>
                        {{ $member->dob->format('d-M-Y') }}
                    </td>
                    <td>
                        {{ $member->phone }}
                    </td>
                    <td>
                        {{ $member->email }}
                    </td>
                    <td class="">
                        <a href="" class="text-primary" data-target="#member-details{{ $member->id }}"
                           data-toggle="modal">
                            More
                        </a>
                        @include('layouts._member-details')
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#members-table').DataTable();
        });
    </script>
@endsection
