<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEYC Airport City | Online Giving</title>

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
        <div class="alert alert-danger">
        <a href="http://ceycairportcity.org/wp-content/uploads/2020/03/Untitled-1.png">
         width=150" height="70">
      </a>
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
                        <form action=" {{ route('payments.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="fullname">
                                    Full Name*
                                </label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">
                                    Phone Number*
                                </label>
                                <input type="tel" name="contact" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="amount">
                                    Amount (In GHS)*
                                </label>
                                <input type="text" name="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Reference*
                                </label>
                                <select name="payment_option" id="" class="form-control custom-select" required>
                                    <option value="" selected disabled>
                                        Select Option
                                    </option>
                                    <option value="Tithe">Tithe</option>
                                    <option value="Offering">Offering</option>
                                    <option value="Seed offering">Seed Offering</option>
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

</html>
