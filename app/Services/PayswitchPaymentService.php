<?php


namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Throwable;

class PayswitchPaymentService
{
    protected $merchantId;

    protected $api_key;

    protected $username;

    protected $uri;

    public function __construct()
    {
        $this->merchantId = config('payswitch.merchant_id');
        $this->username = config('payswitch.username');
        $this->api_key = config('payswitch.api_key');
        $this->uri = 'https://test.theteller.net/v1.1/transaction/process';
    }

    public function mobileMoneyPayment(Array $request)
    {
        $body = [
            'amount' => $this->serializeAmount($request['amount']),
            'processing_code' => '000200',
            'transaction_id' => $request['transaction_id'],
            'desc' => 'CEYC AC Giving',
            'merchant_id' => $this->merchantId,
            'subscriber_number' => $request['mobile_money_number'],
            'r-switch' => $request['mobile_network'],
        ];

        if($request['mobile_network'] === 'VDF') {
            $body = array_push($body, 'voucher_code', $request['voucher_code']);
        }

        try {
            $client = new Client();

            $paymentPromise = $client->postAsync($this->uri, [
                'headers' => $this->headers(),
                'body' => json_encode($body),
                // 'verify' => false
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
                return $response;
            }
            //dd($response);
            $response = json_decode($response->getBody()->getContents());
            return $response;

        } catch (Throwable $th) {
            Log::critical($th->getMessage());
            return Redirect::route('giving.error');
        }
    }

    public function cardPayment($request)
    {
        $body = [
            'amount' => $this->serializeAmount($request['amount']),
            'processing_code' => '000000',
            'transaction_id' => $request['transaction_id'],
            'desc' => 'CEYC AC Giving - Card Payment',
            'merchant_id' => $this->merchantId,
            'r-switch' => $this->validateCard($request['pan']),
            'pan' => $request['pan'],
            'cvv' => $request['cvv'],
            'exp_month' => $request['exp_month'],
            'exp_year' => $request['exp_year'],
            'card_holder' => $request['card_holder'],
            'currency' => 'GHS',
            'customer_email' => $request['email'],
            '3d_url_response' => route('giving.vbv.confirmation'),
        ];

        try {
            $client = new Client();

            $paymentPromise = $client->postAsync($this->uri, [
                'headers' => $this->headers(),
                'body' => json_encode($body),
                'verify' => false
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
                return $response;
            }

            $response = json_decode($response->getBody()->getContents());
            return $response;

        } catch (Throwable $th) {
            Log::critical($th->getMessage());
            return redirect()->route('giving.error');
            //return Redirect::route('giving.error');
        }
    }

    protected function headers() : array
    {
        return [
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
    }

    protected function serializeAmount($amount)
    {
        return sprintf("%'.012d", $amount * 100);

    }

    /**
     * @param string $pan
     * @return RedirectResponse
     */
    protected function validateCard(string $pan)
    {
        //TODO: this implementation will me moved to the card payment request class
        $cards = [
            'VISA' => "/^4[0-9]{12}(?:[0-9]{3})?$/",
            'MAS' => "/^5[1-5][0-9]{14}$/",
        ];

        if (preg_match($cards['VISA'], $pan)) {
            return 'VIS';
        }

        if (preg_match($cards['MAS'], $pan)) {
            return 'MAS';
        }

        return redirect()->back()->withErrors([
            'Improper Card Format, Please check your card number and try again'
        ]);
    }

}
