<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CEYC Airport City | Online Giving</title>


    @include('panels/styles')

    <style>
        html body {
            height: 0% !important;
        }

        .button {
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

        .card-text:after {
            content: "";
            /* This is necessary for the pseudo element to work. */
            display: block;
            /* This will put the pseudo element on its own line. */
            width: 30%;
            /* Change this to whatever width you want. */
            padding-top: 10px;
            /* This creates some space between the element and the border. */
            border-bottom: 3px solid #0a2740;
        }
    </style>

</head>

<body>
<div class="container">
    <div class="container justify-content-center mt-5">
        @if (Session::has('success'))
            <div class="card">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            </div>
        @endif
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold">
                        KINDLY CONFIRM THE PAYMENT DETAILS
                    </h4>
                    <p class="card-text mt-2">
                        Payment Details
                    </p>
                    <div class="row mt-3 mb-2">
                        <div class="col">
                            <p>
                                Full Name
                            </p>
                        </div>
                        <div class="col">
                                <span>
                                    {{ $payment->full_name }}
                                </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <p>
                                Contact
                            </p>
                        </div>
                        <div class="col">
                                <span>
                                    {{ $payment->contact }}
                                </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <p>
                                Amount
                            </p>
                        </div>
                        <div class="col">
                                <span>
                                    GHS {{ $payment->amount }}
                                </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <p>
                                Reference
                            </p>
                        </div>
                        <div class="col">
                                <span>
                                    {{ $payment->giving_option }}
                                </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="button"  data-toggle="modal"
                                    data-target="#momoModal">
                                PAY WITH MoMo
                            </button>
                        </div>
                        <div class="col">
                            <button class="button" data-toggle="modal"
                                    data-target="#visaModal">
                                PAY WITH VISA
                            </button>
                        </div>
                    </div>

                    <!-- Pay with MobileMoney Modal -->
                    <div class="modal fade" id="momoModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">MOBILE MONEY PAYMENT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="">MOBILE NETWORK</label>
                                            <select name="mobile_network" id="" class="form-control custom-select">
{{--                                                <option value="{{ $payment->mobile_network }}" selected>--}}
{{--                                                    {{ $payment->mobile_network }}--}}
{{--                                                </option>--}}
                                                <option value="MTN">MTN</option>
                                                <option value="VDF">Vodafone</option>
                                                <option value="ATL">Airtel</option>
                                                <option value="TGO">Tigo</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">MOBILE NUMBER (Eg:2232456789)</label>
                                            <input type="text" name="contact" value="{{$payment->contact}}"
                                                   class="form-control">
                                        </div>
                                        <div class="alert alert-warning mt-2 mb-2">
                                            <span class="font-weight-bold">
                                                You Will receive a prompt once you click the pay bubtton to authorise
                                                the payment.
                                            </span>
                                        </div>
                                        <button class="button">PAY</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Pay with VISA Modal-->
                    <div class="modal fade" id="visaModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">VISA PAYMENT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="">CARD NUMBER</label>
                                            <input type="text" name="card_number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">CARD HOLDER NAME</label>
                                            <input type="text" name="card_holder_name"
                                                   class="form-control" placeholder="Eg: Abena Abrefa">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Expiry Month</label>
                                            //get a list of all the months in the year and display them
                                            // in the form of numbers eg: 03, 04, 05 etc)
                                            <label for="">Expiry Date</label>
                                            //get a list of all the years in a particular range
                                            // in the form of numbers eg: 18,19,21 etc)
                                        </div>
                                        <button class="button">PAY</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="https://prod.theteller.net/checkout/resource/api/inline/theteller_inline.js">
</script>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Origin': 'https://prod.theteller.net',
            'Access-Control-Allow-Credentials': true,
            'Access-Control-Allow-Headers': '*',
        },
        xhrFields: {
            withCredentials: true
        }
    });
</script>

</html>
