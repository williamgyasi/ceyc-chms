<?php


namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log as Log;
use Symfony\Component\Debug\Exception\FatalErrorException;

class PaymentService
{
    /**
     * Payswitch Payment Endpoint
     * @var string
     */
    public $uri;

    /**
     * Merchant ID
     * @var string
     */
    public $merchantId;

    /**
     * Payswitch Username
     */
    public $username;

    /**
     * Payswitch API Key
     */
    public $api_key;

    public function __construct()
    {
        $this->merchantId = config('payswitch.merchant_id');
        $this->username = config('payswitch.username');
        $this->api_key = config('payswitch.api_key');
        $this->uri = 'https://prod.theteller.net/v1.1/transaction/process';
    }

    /**
     * Process Mobile Money Payment
     * @param Request $request
     * @return RedirectResponse|mixed
     */
    public function mobileMoneyPayment(Request $request)
    {
        $body = [
            'amount' => $this->serializeAmount($request->amount),
            'processing_code' => '000200',
            'transaction_id' => $request->transaction_id,
            'desc' => 'CEYC AC Giving',
            'merchant_id' => $this->merchantId,
            'subscriber_number' => $request->contact,
            'r-switch' => $request->mobile_network,
            'voucher_code' => $request->voucher_code
        ];

        try {
            $client = new Client();

            $paymentPromise = $client->postAsync($this->uri, [
                'headers' => $this->headers(),
                'body' => json_encode($body)
            ])->then(
                function (ResponseInterface $response) {
                    return $response;
                },
                function (RequestException $exception) {
                    $requestMessage = $exception->getMessage();
                    Log::critical($requestMessage);
                    return $exception;
                }
            );

            $response = $paymentPromise->wait();

            if($response instanceof RequestException) {
                $response = $response->getResponse()->getBody();
                $response = json_decode($response);
                Log::critical($response);
                return $response;
            }

            $response = json_decode($response->getBody()->getContents());
            return $response;

        }catch (\Exception $exception) {
            if($exception instanceof FatalErrorException)
            {
                Log::critical($exception->getMessage());
                return redirect()->route('giving.error');
            }

            if($exception instanceof ConnectException)
            {
                Log::critical($exception->getMessage());
                return redirect()->route('giving.error');
            }

            Log::critical($exception->getMessage());
            return redirect()->route('giving.error');
        }
    }

    /**
     * Process Credit Card Payments
     * @param Request $request
     * @return RedirectResponse|mixed
     */
    public function cardPayment(Request $request)
    {
        $body = [
            'amount' => $this->serializeAmount($request->amount),
            'processing_code' => '000000',
            'transaction_id' => $request->transaction_id,
            'desc' => 'CEYC AC Giving - Card Payment',
            'merchant_id' => $this->merchantId,
            'r-switch' => $this->validateCard($request->pan),
            'pan' => $request->pan,
            'cvv' => $request->cvv,
            'exp_month' => $request->exp_month,
            'exp_year' => $request->exp_year,
            'card_holder' => $request->card_holder,
            'currency' => 'GHS',
            'customer_email' => $request->customer_email,
            "3d_url_response" => route('giving.vbv.confirmation'),
        ];

        try {
            $client = new CLient();

            $paymentPromise = $client->postAsync($this->uri, [
                'headers' => $this->headers(),
                'body' => json_encode($body)
            ])->then(
                function (ResponseInterface $response) {
                    return $response;
                },
                function (RequestException $exception) {
                    $requestMessage = $exception->getMessage();
                    Log::critical($requestMessage);
                    return $exception;
                }
            );

            $response = $paymentPromise->wait();

            if($response instanceof RequestException) {
                $response = $response->getResponse()->getBody();
                $response = json_decode($response);
                Log::critical($response);
                return $response;
            }

            $response = json_decode($response->getBody()->getContents());
            return $response;

        }catch (\Exception $exception) {
            if($exception instanceof FatalErrorException)
            {
                Log::critical($exception->getMessage());
                return redirect()->route('giving.error');
            }

            if($exception instanceof ConnectException)
            {
                Log::critical($exception->getMessage());
                return redirect()->route('giving.error');
            }
            
            Log::critical($exception->getMessage());
            return redirect()->route('giving.error');
        }
    }

    /**
     * @return array
     */
    public function headers(): array
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => [
                'Basic ' . base64_encode($this->username . ':' . $this->api_key)
            ],
            'Cache-Control' => 'no-cache',
            'Accept' => 'Accept: */*',
            'User-Agent' => 'guzzle/6.0',
            'Accept-Charset' => '*',
            'Accept-Encoding' => '*',
            'Accept-Ranges' => 'none',
            'Accept-Language' => '*',
        ];

        return $headers;
    }

    /**
     * Method to serialize amount to 12 digits
     * @param $amount
     * @return string
     */
    public function serializeAmount($amount)
    {
        return sprintf("%'.012d", $amount * 100);
    }

    /**
     * @param String $pan
     * @return RedirectResponse|string
     */
    public function validateCard(String $pan)
    {
        $cardTypes = [
            'VISA' => "/^4[0-9]{12}(?:[0-9]{3})?$/",
            'MAS' => "/^5[1-5][0-9]{14}$/",
        ];

        if (preg_match($cardTypes['VISA'], $pan)) {
            return 'VIS';
        }

        if (preg_match($cardTypes['MAS'], $pan)) {
            return 'MAS';
        }

        return redirect()->back();
    }
}
