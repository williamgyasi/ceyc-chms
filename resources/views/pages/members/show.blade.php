@extends('layouts.master')

@section('content')
<div class="container">
    <div class="col-md-6 col-sm-12 offset-md-4">
        <h4 class="mb-3">
            {{ $member->full_name }}'s Details
        </h4>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Lastname :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->lastname }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Firstname :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->firstname }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Other Names :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->othernames ?? 'N/A' }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Date of Birth :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->dob->format('d-M-Y')}}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Phone Number :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->phone }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Alternative Number :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->alt_phone ?? 'N/A' }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Gender :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->gender }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Fellowship :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->fellowship->name}}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Department :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->department->name ?? 'N/A' }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Address :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->residential_address }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Digital Address :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->digital_address ?? 'N/A' }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Email :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->email }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>School :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->school ?? 'N/A'}}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <span>
                    <b>Work :</b>
                </span>
            </div>
            <div class="col">
                {{ $member->work ?? 'N/A'}}
            </div>
        </div>
    </div>
</div>
@endsection