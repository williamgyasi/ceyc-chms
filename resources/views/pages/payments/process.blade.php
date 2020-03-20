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

        button {
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
                                    {{ $payment->name }}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <p>
                                    Email
                                </p>
                            </div>
                            <div class="col">
                                <span>
                                    {{ $payment->email }}
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
                                    {{ $payment->tel }}
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
                                    {{ $payment->payment_option }}
                                </span>
                            </div>
                        </div>
                        <a class="ttlr_inline" 
                            data-APIKey="OGZhMmM0Yzg3NmFiNTgzNjdlZTUyNjAxYzg2ZGVhMDA="
                            data-transid="{{ $transactionId }}" 
                            data-amount="{{ $payment->amount }}"
                            data-customer_email="{{ $payment->email }}" 
                            data-currency="GHS"
                            data-redirect_url="http://127.0.0.1:8000/payments/confirmation/response/" 
                            data-pay_button_text="Give"
                            data-custom_description="Payment Using CEYC-AC Payment Platform" data-payment_method="both">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://test.theteller.net/checkout/resource/api/inline/theteller_inline.js">
</script>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Headers': '*',
        }
    });
</script>

</html>
