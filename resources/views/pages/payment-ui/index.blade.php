<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width ; initial-scale=1.0 ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    </head>

    <body>
        <div class="wrapper">
            <div class="row container">
        
                <div class="inner__container">
                    <div class="info__container">
                        <!-- <form>
                            <label for="fname">First name:</label><br>
                            <input type="text" id="fname" name="fname"><br>
                            <label for="lname">Last name:</label><br>
                            <input type="text" id="lname" name="lname">
                          </form>
                           -->
                        

                    </div>

                    <div class="card__container">
                        <h2>Payment Method</h2>
                        <div class="options__payment">
                            <label for="1">Visa</label>
                            <input type="radio" name="visa-card" id="1" value="1" required>
                            <label for="2">Mobile Money</label>
                            <input type="radio" name="visa-card" id="2" value="1" required>
                        </div>

                        <div class="card__component">
                            <div class="card__component__visa card__component__visa--front">
                                &nbsp;
                            </div>
                            <div class="card__component__visa card__component__visa--back">
                                i am at the back
                            </div>
                        </div>
                        

                    </div>
                </div>
                 

            </div>
        </div>
    </body>
</html>