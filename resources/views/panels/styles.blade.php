{{-- Vendor Styles --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600">

<link href="{{ asset('vendors/css/vendors.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/css/ui/prism.min.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">


<!-- Theme Styles -->
<link rel="stylesheet" href="{{ asset(mix('css/bootstrap.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/bootstrap-extended.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/colors.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/components.css')) }}">

{{-- {!! Helper::applClasses() !!} --}}
@php 
$configData = Helper::applClasses();
@endphp

@if($configData['theme'] == 'dark-layout')
    <link rel="stylesheet" href="{{ asset(mix('css/themes/dark-layout.css')) }}">
@endif
@if($configData['theme'] == 'semi-dark-layout')
    <link rel="stylesheet" href="{{ asset(mix('css/themes/semi-dark-layout.css')) }}">
@endif

<!-- Page Styles -->
<link rel="stylesheet" href="{{ asset(mix('css/core/menu/menu-types/vertical-menu.css')) }}">

<!--Select-2 CSS-->
{{-- <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/select2-custom.css') }}">

<!--Flat Picker CSS-->
<link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">

<!--Core CEYC CHMS CSS-->
<link rel="stylesheet" href="{{ asset('css/core/core.css') }}">

{{-- <link rel="stylesheet" href="/css/notika-custom-icon.css"> --}}

<link rel="stylesheet" href="{{ asset('css/notika-custom-icon.css') }}">

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

<!-- Font Awesome-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" 
crossorigin="anonymous">