@extends('layouts.master')

@section('pageStyle')

    <link rel="stylesheet" href="{{ asset('css/pages/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div id="chart-apex"></div>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>
                            Total Amount Today
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h1 class="text-bold-700">
                                GH¢ {{ $approvedGivings->sum('amount') }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6>
                            Total Approved
                        </h6>
                        <i class="fa fa-circle text-success pb-1"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h2 class="text-bold-700">
                                {{ $approvedGivings->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6>
                            Total Declined
                        </h6>
                        <i class="fa fa-circle text-warning pb-1"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h2 class="text-bold-600">
                                {{ $declinedGivings->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6>
                            Failed
                        </h6>
                        <i class="fa fa-circle text-danger pb-1"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h2 class="text-bold-700">
                                {{ $failedGivings->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 font-weight-bolder">
                            Payments - {{ Carbon\Carbon::today()->format('d.M.Y') }}
                        </h4>
                        <hr class="font-weight-bolder">
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive mt-1 p-1">
                                <table class="table table-hover-animation mb-2 border-0">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NAME</th>
                                        <th>CONTACT</th>
                                        <th>AMOUNT (GH¢)</th>
                                        <th>REFERENCE</th>
                                        <th>STATUS</th>
                                        <th>TRANSACTION ID</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($currentDayGivings as $payment)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $payment->full_name }}
                                            </td>
                                            <td>
                                                {{ $payment->contact }}
                                            </td>
                                            <td>
                                                {{ $payment->amount }}
                                            </td>
                                            <td>
                                                {{ $payment->giving_option }}
                                            </td>
                                            <td>
                                                @if($payment->payment_status == 'Approved' || $payment->payment_status ==
                                                 'approved')
                                                    <span class="text-success">
                                                         {{ ucwords($payment->payment_status) }}
                                                    </span>

                                                @elseif($payment->payment_status == 'Declined' ||
                                                    $payment->payment_status == 'declined')
                                                    <span class="text-warning">
                                                        {{ ucwords($payment->payment_status) }}
                                                </span>
                                                @else
                                                    <span class="text-danger">
                                                    Failed
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $payment->transaction_id }}
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

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 font-weight-bolder">
                            All Payments
                        </h4>
                        <hr class="font-weight-bolder">
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive mt-0 p-2">
                                <div class="container-fluid bg-rgba-light height-90 p-2 rounded mb-3">
                                    <div class="row justify-content-between">
                                        <h6>
                                            Filters
                                            <i class="fa fa-filter pl-0"></i>
                                        </h6>
                                        <a href="">Clear Filters</a>
                                    </div>
                                    <div class="row mt-1">
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
                                                   name="date" class="form-control datepicker"
                                                   placeholder="Start Date">
                                        </div>
                                        <div class="col pb-1">
                                            <input type="text" id="end-date"
                                                   name="endDate" class="form-control datepicker"
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
                                    </div>
                                </div>
                                <table id="all-payments" class="table table-hover-animation mb-2 border-0">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NAME</th>
                                        <th>CONTACT</th>
                                        <th>AMOUNT (GH¢)</th>
                                        <th>REFERENCE</th>
                                        <th>STATUS</th>
                                        <th>TRANSACTION ID</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($givings as $payment)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $payment->full_name }}
                                            </td>
                                            <td>
                                                {{ $payment->contact }}
                                            </td>
                                            <td>
                                                {{ $payment->amount }}
                                            </td>
                                            <td>
                                                {{ $payment->giving_option }}
                                            </td>
                                            <td>
                                                @if($payment->payment_status == 'Approved' || $payment->payment_status ==
                                                'approved')
                                                    <span class="text-success">
                                                         {{ ucwords($payment->payment_status) }}
                                                    </span>

                                                @elseif($payment->payment_status == 'Declined' ||
                                                    $payment->payment_status == 'declined')
                                                    <span class="text-warning">
                                                        {{ ucwords($payment->payment_status) }}
                                                </span>
                                                @else
                                                    <span class="text-danger">
                                                    Failed
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $payment->transaction_id }}
                                            </td>
                                            <td>
                                                {{ $payment->created_at->format('d-M-Y') }}
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/payment-dashboard.js') }}"></script>
    <script src="{{ asset('js/range_dates.js') }}"></script>
@endsection
