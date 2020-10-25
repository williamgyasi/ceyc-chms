<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEYC AIPORT-CITY | Payments</title>

    @include('panels/styles')

</head>
<body>
<div class="container justify-content-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                    <span style="font-size: 150px; color:red" class="text-center">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                <div class="row justify-content-center">
                    <span class="font-weight-600">
                        Looks like something went wrong.
                    </span>
                    <strong>
                        {{ Session::get('error') }}
                    </strong>
                </div>
                <p class="text-center">
                    Click <a href="https://give.ceycairportcity.org/giving/">Here</a> to try again.
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
