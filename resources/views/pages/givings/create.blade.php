<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD:resources/views/pages/givings/create.blade.php
    <title>CEYC AIPORT-CITY | Online Giving</title>
=======
    <title>CEYC Airport City | Online Giving</title>
>>>>>>> 369650d59ea6108ac5cc752bbf36d8d05c8df08e:resources/views/pages/payments/create.blade.php

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
                <img src='http://ceycairportcity.org/wp-content/uploads/2020/03/Untitled-1.png'>
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold justify-content-center">
                            ONLINE GIVING
                        </h4>
                        <p class="card-text mt-2">
                            Kindly Fill Out The Form To Complete Your Giving
                        </p>
                        <form action=" {{ route('giving.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="fullname">
                                    Full Name*
                                </label>
<<<<<<< HEAD:resources/views/pages/givings/create.blade.php
                                <input type="text" name="full_name" class="form-control" required>
=======
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">
                                    Phone Number*
                                </label>
                                <input type="tel" name="contact" class="form-control" required>
>>>>>>> 369650d59ea6108ac5cc752bbf36d8d05c8df08e:resources/views/pages/payments/create.blade.php
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Phone Number</label>
                                <input type="text" name="contact" class="form-control" minlength="10" maxlength="10" required>
                            </div>
                            <div class="form-group">
                                <label for="amount">
                                    Amount (In GHS)*
                                </label>
<<<<<<< HEAD:resources/views/pages/givings/create.blade.php
                                <input type="number" name="amount" class="form-control" required>
=======
                                <input type="text" name="amount" class="form-control" required>
>>>>>>> 369650d59ea6108ac5cc752bbf36d8d05c8df08e:resources/views/pages/payments/create.blade.php
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Reference*
                                </label>
<<<<<<< HEAD:resources/views/pages/givings/create.blade.php
                                <select name="giving_option" id="" class="form-control custom-select" required>
=======
                                <select name="payment_option" id="" class="form-control custom-select" required>
>>>>>>> 369650d59ea6108ac5cc752bbf36d8d05c8df08e:resources/views/pages/payments/create.blade.php
                                    <option value="" selected disabled>
                                        Select Option
                                    </option>
                                    <option value="Tithe">Tithe</option>
                                    <option value="Offering">Offering</option>
<<<<<<< HEAD:resources/views/pages/givings/create.blade.php
                                    <option value="Seed Offering">Seed Offering</option>
                                    <option value="Special Seed Offering">Special Seed Offering</option>
=======
                                    <option value="Seed offering">Seed Offering</option>
>>>>>>> 369650d59ea6108ac5cc752bbf36d8d05c8df08e:resources/views/pages/payments/create.blade.php
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
