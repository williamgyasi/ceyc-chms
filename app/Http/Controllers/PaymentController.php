<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' =>  'required',
            'email' =>  'required',
            'amount' =>  'required',
            'payment_option' =>  'required'
        ]);
        
        $payment = Payment::create($attributes);

        if ($payment->save()) {
            
            return redirect()->route('payments.process', compact('payment'));

        } else {
            
            return redirect()->back()->withError();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    /**
     * @param \App\Payment $payment
     */
    public function process($payment)
    {
        $payment = Payment::findOrFail($payment);

        $transactionId = bin2hex(random_bytes(6));

        return view('pages.payments.process', compact('payment', 'transactionId'));
    }

    public function confirm(Request $request, $response)
    { 
        dd($request->all());
        $curl = curl_init();

        $transactionId = $request->get('transactionID');
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://test.theteller.net/v1.1/users/transactions/".$transactionId."/status",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Merchant-Id: TTM-00000086"
          ),
        ));
        
        $response = curl_exec($curl);
        // dd($response);
        $err = curl_error($curl);
        
        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {

            return redirect()
                    ->route('payments.confirm' ,['status' => $response]);
        }
    }
}
