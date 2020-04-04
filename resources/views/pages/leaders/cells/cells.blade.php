@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row mb-2 mt-2">
            <h3 class="mb-2 font-weight-bold">
                {{ Auth::user()->fellowship->name }} Fellowship - Cells
            </h3>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="" class="btn btn-primary" data-toggle="modal"
               data-target="#create-cell-modal">
                New Cell
            </a>
        </div>

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


        <div class="table-responsive">
            <table class="table" id="cells-table">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>CELL NAME</th>
                    <th>LEADER</th>
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cells as $cell)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $cell->name }}
                        </td>
                        <td>
                            {{ $cell->leader }}
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#cell-info-modal{{ $cell->id }}">
                                More
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!--Modal To add a new cell-->
    <div class="modal fade" id="create-cell-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add New Cell
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fellowship.cell.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Cell Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Leader</label>
                            <select name="leader" id="" class="custom-select">
                                <option value="" selected disabled>Select Cell Leader</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->full_name }}">
                                        {{ $member->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary btn-block">SAVE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal to view cell information-->
    <div class="modal fade" id="cell-info-modal{{ $cell->id }}" tabindex="-1" role="dialog"
         aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $cell->name }} Cell
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Total Members
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <h2 class="font-weight-bold-700">
                                            {{ App\User::whereCellId($cell->id)->count() }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Total Male
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <h2 class="font-weight-bold-700">
                                            {{ App\User::whereCellId($cell->id)->whereGender('Male')->count() }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Total Female Members
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <h2 class="font-weight-bold-700">
                                            {{ App\User::whereCellId($cell->id)->whereGender('Female')->count() }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#cells-table').DataTable();
        });
    </script>
@endsection
