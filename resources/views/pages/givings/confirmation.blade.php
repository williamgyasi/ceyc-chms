<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Refresh" content="7; url=https://ceycairportcity.org/" />
    <title>CEYC AIPORT-CITY | Payments</title>

    @include('panels/styles')

</head>

<body>
    <div class="container justify-content-center mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <span style="font-size: 150px; color:#00A676" class="text-center">
                        <i class="far fa-check-circle"></i>
                    </span>
                    <div class="row justify-content-center">
                        <strong>
                            {{ Session::get('success') }}
                        </strong>
                    </div>
                    <p class="text-center">
                        Click <a href="https://ceycairportcity.org/">Here</a> to go back to our website.
                        Redirecting you back to our homepage
                    </p>   
                    @if (Session::has('success'))
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
