<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CEYC AIRPORT CITY | Online Giving</title>
    @include('panels/styles')

    <link rel="stylesheet" href="{{ asset('css/givings/giving.css') }}">
</head>

<body>
    <section class="container px-5 mb-2 mt-2">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            <h4 class="font-weight-bold">
                Giving Details
            </h4>
        </div>
        <hr>

        <ul class="nav nav-tabs nav-fill mt-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active pb-1" id="card-tab" data-toggle="tab" href="#card" role="tab"
                    aria-controls="card" aria-selected="true">
                    <i class="fas fa-credit-card"></i>
                    Pay with  Card
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pb-1" id="momo-tab" data-toggle="tab" href="#momo" role="tab"
                    aria-controls="profile" aria-selected="false">
                    <i class="fas fa-mobile"></i>
                    Pay with Mobile Money
                </a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Pay with Card Tab Content -->
            <div class="tab-pane fade show active" id="card" role="tabpanel" aria-labelledby="card-tab">
                <form action="{{ route('v2-card-giving') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Fullname" class="font-weight-bold">Fullname</label>
                                <input type="text" name="full_name" id="" class="form-control" placeholder="Fullname" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Mobile Number" class="font-weight-bold">Mobile Number</label>
                                <input type="tel" name="contact" id="" class="form-control" placeholder="Mobile Number" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="Amount" class="font-weight-bold">
                                Amount (GHS)
                            </label>
                            <input type="number" name="amount" min="1" class="form-control" placeholder="Amount In Ghana Cedis" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Giving Reference" class="font-weight-bold">
                                    Giving Reference
                                </label>
                                <select name="giving_option" id="showPartnershipArms" class="custom-select" required>
                                    <option value="" selected disabled>
                                        Select Option
                                    </option>
                                    <option value="Tithe">Tithe</option>
                                    <option value="Offering">Offering</option>
                                    <option value="Seed Offering">Seed</option>
                                    <option value="Special Seed Offering">Special Seed</option>
                                    <option value="Vow">Vow</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Email Address</label>
                              <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group" id="partnershipArmsDiv">
                                <label for="">Partnership Arms</label>
                                <select name="partnership_arms" id="partnershipArms" class="custom-select">
                                    <option value="" selected>Select Partnership Arm</option>
                                    <option value="Rhapsody">Rhapsody</option>
                                    <option value="Healing School">Healing School</option>
                                    <option value="Inner City Missions">Inner City Missions</option>
                                    <option value="IMM">IMM</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <h5 class="font-weight-bold">
                                Card Details
                            </h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Card Number" class="font-weight-bold">Card Number</label>
                                <input type="text" name="pan" class="form-control" minlength="16"
                                    maxlength="16" required placeholder="Card Number">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Card Holder Name" class="font-weight-bold">Card Holder Name</label>
                                <input type="text" name="card_holder" class="form-control"
                                    placeholder="Eg: Abena Abrefa">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                       <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Expiry Date" class="font-weight-bold">Expiry Date</label>
                                <div class="row">
                                    <div class="col">
                                        <select name="exp_month" class="form-control">
                                            <option value="" selected disabled>MM</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    /
                                    <div class="col">
                                        <select name="exp_year" class="form-control">
                                            <option value="" selected disabled>YY</option>
                                            <option value="20"> 2020</option>
                                            <option value="21"> 2021</option>
                                            <option value="22"> 2022</option>
                                            <option value="23"> 2023</option>
                                            <option value="24"> 2024</option>
                                            <option value="25"> 2025</option>
                                            <option value="26"> 2026</option>
                                            <option value="27"> 2027</option>
                                            <option value="28"> 2028</option>
                                            <option value="29"> 2029</option>
                                            <option value="30"> 2030</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                             <label for="CVV" class="font-weight-bold">CVV</label>
                             <input type="number" any name="cvv" id="" class="form-control" placeholder="eg: 433">
                           </div>
                       </div>
                    </div>
                    <button class="btn btn-primary btn-block" id="trigger-card-payment">PAY</button>
                </form>
            </div>

            <!-- Pay with Momo Tab Content -->
            <div class="tab-pane fade" id="momo" role="tabpanel" aria-labelledby="profile-tab">
                <form action="{{ route('v2-momo-giving') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Fullname" class="font-weight-bold">Fullname</label>
                                <input type="text" name="full_name" id="" class="form-control" placeholder="Fullname" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Mobile Number" class="font-weight-bold">Mobile Number</label>
                                <input type="tel" name="contact" id="" class="form-control" placeholder="Mobile Number" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="Amount" class="font-weight-bold">
                                Amount (GHS)
                            </label>
                            <input type="number" name="amount" min="1" class="form-control" placeholder="Amount In Ghana Cedis" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Giving Reference" class="font-weight-bold">
                                    Giving Reference
                                </label>
                                <select name="giving_option" id="showPartnershipArmsForMomo" class="custom-select" required>
                                    <option value="" selected disabled>
                                        Select Option
                                    </option>
                                    <option value="Tithe">Tithe</option>
                                    <option value="Offering">Offering</option>
                                    <option value="Seed Offering">Seed</option>
                                    <option value="Special Seed Offering">Special Seed</option>
                                    <option value="Vow">Vow</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" id="partnershipArmsDivForMomo">
                                <label for="">Partnership Arms</label>
                                <select name="partnership_arms" id="partnershipArmsForMomo" class="custom-select">
                                    <option value="" selected>Select Partnership Arm</option>
                                    <option value="Rhapsody">Rhapsody</option>
                                    <option value="Healing School">Healing School</option>
                                    <option value="Inner City Missions">Inner City Missions</option>
                                    <option value="IMM">IMM</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Mobile Network" class="font-weight-bold">Mobile Network</label>
                                <select name="mobile_network" id="seeAnotherField" class="form-control
                                    custom-select">
                                    <option value="">Select Mobile Network</option>
                                    <option value="MTN">MTN</option>
                                    <option value="VDF">Vodafone</option>
                                    <option value="ATL">Airtel</option>
                                    <option value="TGO">Tigo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Mobile Money Number" class="font-weight-bold">Mobile Money Number (Eg:0241223450)</label>
                                <input type="tel" name="mobile_money_number" value="" class="form-control" required
                                    placeholder="Mobile Money Number">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group" id="otherFieldDiv">
                                <label for="vf_voucher_field" class="font-weight-bold">
                                    Vodafone Voucher Code
                                </label>
                                <input type="number" name="voucher_code" class="form-control"
                                    id="otherField" placeholder="Vodafone Users Only">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="alert alert-info mb-2">
                                <span class="font-weight-bold">
                                    Kindly Approve Payment When Prompted.
                                </span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" id="trigger-momo-payment">PAY</button>
                </form>
            </div>
        </div>
    </section>
</body>

<script src="{{ asset('/js/app.js') }}"></script>
<script>
    $("#showPartnershipArms").change(function () {
        if ($(this).val() == "Partnership") {
            $('#partnershipArmsDiv').show();
            $('#partnershipArms').attr('required', '');
            $('#partnershipArms').attr('data-error', 'This field is required.');
        } else {
            $('#partnershipArmsDiv').hide();
            $('#partnershipArms').removeAttr('required');
            $('#partnershipArms').removeAttr('data-error');
        }
    });
    $("#showPartnershipArms").trigger("change");

    $("#showPartnershipArmsForMomo").change(function () {
        if ($(this).val() == "Partnership") {
            $('#partnershipArmsDivForMomo').show();
            $('#partnershipArmsForMomo').attr('required', '');
            $('#partnershipArmsForMomo').attr('data-error', 'This field is required.');
        } else {
            $('#partnershipArmsDivForMomo').hide();
            $('#partnershipArmsForMomo').removeAttr('required');
            $('#partnershipArmsForMomo').removeAttr('data-error');
        }
    });
    $("#showPartnershipArmsForMomo").trigger("change");

    $("#seeAnotherField").change(function () {
        if ($(this).val() == "VDF") {
            $('#otherFieldDiv').show();
            $('#otherField').attr('required', '');
            $('#otherField').attr('data-error', 'This field is required.');
        } else {
            $('#otherFieldDiv').hide();
            $('#otherField').removeAttr('required');
            $('#otherField').removeAttr('data-error');
        }
    });
    $("#seeAnotherField").trigger("change");

    // $(document).ready(function () {
    //     $("#trigger-card-payment").click(function () {
    //         // disable button
    //         $(this).prop("disabled", true);
    //         // add spinner to button
    //         $(this).html(
    //             `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
    //             </span> Processing...`
    //         );
    //     });
    // });

    // $(document).ready(function () {
    //     $("#trigger-momo-payment").click(function () {
    //         // disable button
    //         $(this).prop("disabled", true);
    //         // add spinner to button
    //         $(this).html(
    //             `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
    //             </span> Processing...`
    //         );
    //     });
    // });
</script>

</html>
