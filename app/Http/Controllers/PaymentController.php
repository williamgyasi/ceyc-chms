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
            $transactionId = sprintf("%'.012d", random_int(1, 1000) . $request->amount*100);

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
     * @throws Exception
     */
    private function makePaymentApiRequest($payment)
    {
        $baseURI = 'https://prod.theteller.net/v1.1/transaction/process';

        $client = new Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => [
                'Basic ' . base64_encode('jumeni5b92c307c2861:ZGFkZGRiYWNkMzUzY2JhZTdjYTRhY2NkOTM2MTNiNjM=')
            ],
            'Cache-Control' => 'no-cache',
            'Accept' => 'Accept: */*',
            'User-Agent' => 'guzzle/6.0',
            'Accept-Charset' => '*',
            'Accept-Encoding' => '*',
            'Accept-Ranges' => 'none',
            'Accept-Language' => '*',
        ];

        $amount = sprintf("%'.012d", $payment->amount *100);

        $body = [
            'amount' => $amount,
            'processing_code' => '000200',
            'transaction_id' => $payment->transaction_id,
            'desc' => 'CEYC AC Giving',
            'merchant_id' => "TTM-00000086",
            'subscriber_number' => $payment->contact,
            'r-switch' => $payment->mobile_network
        ];

        $response = $client->request('POST', $baseURI, [
            'headers' => $headers,
            'body' => json_encode($body),
        ]);

        $statusCode = $response->getStatusCode();

        dd($response->getBody()->getContents());

    }
}
