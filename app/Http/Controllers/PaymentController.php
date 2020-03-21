<?php

namespace App\Http\Controllers;

use App\Payment;
use Exception;
use GuzzleHttp\Client as Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('pages.givings.direct-payment');
    }

    /**
     * Method to store a newly created giving resource to database
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function store(Request $request)
    {
        try {
            $attributes = $this->validate($request, [
                'full_name' => 'required',
                'email' => 'required',
                'mobile_network' => 'required',
                'contact' => 'required',
                'amount' => 'required',
                'giving_option' => 'required'
            ]);
            $transactionId = random_int(10, 100) . bin2hex(random_bytes(5));

            $slug = Carbon::today()->format('dmyg') . bin2hex(random_bytes(5)) . Str::slug($request->full_name);

            $payment = Payment::create($attributes +
                [
                    'transaction_id' => $transactionId,
                    'slug' => $slug
                ]);

            $this->makePaymentApiRequest($payment);

            return redirect()->route('payment.confirm', compact('payment'));

        } catch (ValidationException $e) {
            $e->validator->errors()->getMessages();
        }
    }

    public function confirm()
    {
        return view('pages.givings.direct-confirm');
    }

    /**
     * Method to send payload for payment
     * @param $payment
     */
    private function makePaymentApiRequest($payment)
    {
        $baseURI = 'https://prod.theteller.net/v1.1/transaction/process';

        $client = new Client();

        $response = $client->request('POST', $baseURI,[
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => ['Basic ' . base64_encode('jumeni5b92c307c2861:ZGFkZGRiYWNkMzUzY2JhZTdjYTRhY2NkOTM2MTNiNjM=')],
                'Cache-Control' => 'no-cache',
                'Accept' => 'Accept: */*',
                'User-Agent' => 'guzzle/6.0',
                'Accept-Charset' => '*',
                'Accept-Encoding' => '*',
                'Accept-Ranges' => 'none',
                'Accept-Language' => '*',
            ],
            'form_params' => [
                'amount' => $payment->amount,
                'processing_code' => '000200',
                'transaction_id' => $payment->transaction_id,
                'desc' => 'CEYC AC Giving',
                'merchant_id' => 'TTM-00000086',
                'subscriber_number' => $payment->contact,
                'r-switch' => $payment->mobile_network
            ]]);

        $statusCode = $response->getStatusCode();

        dd($statusCode);

    }
}
