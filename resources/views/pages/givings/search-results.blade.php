@extends('layouts.master')

@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('content')
    <section class="container">
        <div class="mb-3">
            <h4>
                Filtered Results
            </h4>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive p-2">
                                <div class="container-fluid bg-rgba-light height-90 p-2 rounded mb-3">
                                    <div class="row justify-content-between">
                                        <h6>
                                            Filters
                                            <i class="fa fa-filter pl-0"></i>
                                        </h6>
                                        <a href="">Clear Filters</a>
                                    </div>
                                    <div class="row mt-1">
                                        <form action="{{ route('givings.search') }}" method="GET">
                                            <div class="row px-2">
                                                <div class="col pb-1">
                                                    <select name="status" id="pay" class="custom-select">
                                                        <option value="">
                                                            Payment Status
                                                        </option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Declined">Declined</option>
                                                        <option value="Failed">Failed</option>
                                                    </select>
                                                </div>
                                                <div class="col pb-1">
                                                    <input type="date" id="date"
                                                           name="start_date" class="form-control datepicker"
                                                           placeholder="Start Date">
                                                </div>
                                                <div class="col pb-1">
                                                    <input type="date" id="end-date"
                                                           name="end_date" class="form-control datepicker"
                                                           placeholder="End Date">
                                                </div>
                                                <div class="col pb-1">
                                                    <select name="reference" id="reference" class="custom-select">
                                                        <option value="">
                                                            Reference
                                                        </option>
                                                        <option value="Tithe">Tithe</option>
                                                        <option value="Offering">Offering</option>
                                                        <option value="Seed Offering">Seed Offering</option>
                                                        <option value="Special Seed Offering">Special Seed Offering</option>
                                                        <option value="Vow">Vow</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-primary btn-block">
                                                        FILTER
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-hover-animation mb-2 givings">
                                    <thead>
                                        <th>No.</th>
                                        <th>NAME</th>
                                        <th>CONTACT</th>
                                        <th>AMOUNT (GH¢)</th>
                                        <th>REFERENCE</th>
                                        <th>STATUS</th>
                                        <th>TRANSACTION ID</th>
                                        <th>DATE</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($givings as $giving)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $giving->full_name }}
                                                </td>
                                                <td>
                                                    {{ $giving->contact }}
                                                </td>
                                                <td>
                                                    {{ $giving->amount }}
                                                </td>
                                                <td>
                                                    {{ $giving->giving_option }}
                                                </td>
                                                <td>
                                                    @if($giving->payment_status === 'Approved')
                                                        <span class="text-success">
                                                            {{ ucwords($giving->payment_status) }}
                                                        </span>
                                                    @elseif($giving->payment_status === 'Declined')
                                                        <span class="text-warning">
                                                            {{ ucwords($giving->payment_status) }}
                                                        </span>
                                                    @else
                                                        <span class="text-danger">Failed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $giving->transaction_id }}
                                                </td>
                                                <td>
                                                    {{ $giving->created_at->format('d-M-Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="{{ asset('js/flatpickr.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.givings').DataTable();
            $(".datepicker").flatpickr({
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endsection
