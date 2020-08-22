<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEYC AIPORT CITY | Online Giving</title>

    @include('panels/styles')
    <style>
        html body {
            height: 0% !important;
        }
        button{
            display: block !important;
            width: 100% !important;
            border: 1px solid transparent !important;
            text-align: center !important;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.6;
            border-radius: 0.25rem;
            user-select: none;
            font-weight: 400;
            background-color: #0a2740 !important;
            color: white;
        }
    </style>
</head>

<body>
<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold justify-content-center">
                        ONLINE GIVING
                    </h4>
                    <p class="card-text mt-2">
                        Kindly Fill Out The Form To Complete Your Giving
                    </p>

                    <form action=" {{ route('payment.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="fullname">
                                Full Name*
                            </label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="email" value="tech@ceycairportcity.org">
                        </div>
                        <div class="form-group">
                            <label for="mobile-network">
                                Mobile Network
                            </label>
                            <select name="mobile_network" id="display_voucher_field" class="form-control custom-select">
                                <option value="" selected disabled>Select Mobile Network</option>
                                <option value="MTN">MTN</option>
                                <option value="VDF">Vodafone</option>
                                <option value="ATL">Airtel</option>
                                <option value="TGO">Tigo</option>
                            </select>
                        </div>

                        <!-- <div class="form-group" id="voucher_field">
                        <label for="vf_voucher_field">Vodafone Voucher Code</label>
                            <input type="number" name="voucher_code" class="form-control" id=voucher_field required>

                        </div> -->
                        <div class="form-group">
                            <label for="contact">Phone Number*</label>
                            <input type="tel" name="contact" class="form-control" minlength="10" maxlength="15"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="amount">
                                Amount (In GHS)*
                            </label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">
                                Reference*
                            </label>
                            <select name="giving_option" id="" class="form-control custom-select" required>
                                <option value="" selected disabled>
                                    Select Option
                                </option>
                                <option value="Tithe">Tithe</option>
                                <option value="Offering">Offering</option>
                                <option value="Seed Offering">Seed Offering</option>
                                <option value="Special Seed Offering">Special Seed Offering</option>
                                <option value="Vow">Vow</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <button type="submit">CONFIRM</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<!-- <script>
$("#display_voucher_field").change(function() {
  if ($(this).val() == "VDF") {
    $('#voucher_field').show();
    $('#vf_voucher_field').attr('required', '');
    $('#vf_voucher_field').attr('data-error', 'This field is required.');
  } else {
    $('#voucher_field').hide();
    $('#vf_voucher_field').removeAttr('required');
    $('#vf_voucher_field').removeAttr('data-error');
  }
});
$("#display_voucher_field").trigger("change");

$("#display_voucher_fieldGroup").change(function() {
  if ($(this).val() == "yes") {
    $('#vf_voucher_fieldGroupDiv').show();
    $('#vf_voucher_field1').attr('required', '');
    $('#vf_voucher_field1').attr('data-error', 'This field is required.');
    $('#vf_voucher_field2').attr('required', '');
    $('#vf_voucher_field2').attr('data-error', 'This field is required.');
  } else {
    $('#vf_voucher_fieldGroupDiv').hide();
    $('#vf_voucher_field1').removeAttr('required');
    $('#vf_voucher_field1').removeAttr('data-error');
    $('#vf_voucher_field2').removeAttr('required');
    $('#vf_voucher_field2').removeAttr('data-error');
  }
});
$("#display_voucher_fieldGroup").trigger("change");
</script> -->
</html>
