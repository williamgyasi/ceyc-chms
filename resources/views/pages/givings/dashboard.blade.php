@extends('layouts.master')

@section('pageStyle')

    <link rel="stylesheet" href="{{ asset('css/pages/dashboard.css') }}">

    {{--    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">--}}

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6>
                                Total Amount Today
                            </h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <h1 class="text-bold-700">
                                    GH¢ {{ $approvedPayments->sum('amount') }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
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
                                {{ $approvedPayments->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6>
                            Total Declined
                        </h6>
                        <i class="fa fa-circle text-danger pb-1"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h2 class="text-bold-600">
                                {{ $declinedPayments->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6>
                            Others
                        </h6>
                        <i class="fa fa-circle text-secondary pb-1"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h2 class="text-bold-700">
                                {{ $otherPayments->count() }}
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
                                @foreach($currentDayPayments as $payment)
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
                                                <span class="text-danger">
                                                        {{ ucwords($payment->payment_status) }}
                                                    </span>
                                            @else
                                                {{ ucwords($payment->payment_status ?? 'N/A') }}
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
                                @foreach($payments as $payment)
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
                                                <span class="text-danger">
                                                        {{ ucwords($payment->payment_status) }}
                                                    </span>
                                            @else
                                                {{ ucwords($payment->payment_status ?? 'N/A') }}
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
@endsection
