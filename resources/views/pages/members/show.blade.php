@extends('layouts.master')

@section('content')

    <div class="container mb-5">
        <div class="row justify-content-center">
            <h3 class="font-weight-bolder">
                {{ $member->full_name  }}'s Details
            </h3>
        </div>
        <div class="container justify-content-start mt-3">
            <div class="row">
                <!-- Personal Information Column-->
                <div class="col">
                    <h5 class="font-weight-bold">
                         Personal Details
                    </h5>
                    <hr class="font-weight-bolder bg-rgba-black">
                    <div class="row pl-2 pr-2">
                        <div class="col">
                            <span>
                                Date of Birth
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->dob->format('d-M-Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Phone Number
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->phone }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Alternative Number
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->alt_phone ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Email
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->email }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Gender
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->gender }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Address
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->residential_address }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Digital Address
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->digital_address ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                School
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->school ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Place of Work
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->work ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Other Details Column-->
                <div class="col">
                    <h5 class="font-weight-bold">
                        Other Details
                    </h5>
                    <hr class="font-weight-bolder bg-rgba-black">
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Fellowship
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->fellowship->name }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Cell
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->cell->name ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                    <div class="row pl-2 pr-2 mt-1">
                        <div class="col">
                            <span>
                                Department
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                {{ $member->department->nam ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
