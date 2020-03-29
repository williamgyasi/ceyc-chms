<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as Log;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Whoops\Exception\ErrorException;

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

    public function __construct()
    {
        $this->merchantId = "TTM-00000086";
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

            $paymentResponse = $client->request('POST',
                $this->uri, [
                'headers' => $this->headers(),
                'body' => json_encode($body)
            ]);

            $response = json_decode(
                $paymentResponse->getBody()
                    ->getContents());

            return $response;

        } catch (ConnectException $exception) {
            Log::critical($exception->getMessage());
            return redirect()->route('giving.error');

        } catch (FatalErrorException $e) {
            Log::critical($e->getMessage());
            return redirect()->route('giving.error');
        } catch (ErrorException $errorException) {
            Log::error($errorException->getMessage());
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
            "3d_url_response" => 'https://ceycairportcity.org/',
        ];

        try{
            $client = new CLient();

            $paymentResponse = $client->request('POST' ,
                $this->uri,[
                    'headers' => $this->headers(),
                    'body' => json_encode($body)
                ]);

            $response = json_decode(
                $paymentResponse->getBody()
                    ->getContents());

            return $response;

        } catch (ConnectException $exception) {
            Log::critical($exception->getMessage());
            return redirect()->route('giving.error');

        } catch (FatalErrorException $e) {
            Log::critical($e->getMessage());
            return redirect()->route('giving.error');
        }
    }

    /**
     * @return Array
     */
    public function headers() : array
    {
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
            'MAS'  => "/^5[1-5][0-9]{14}$/",
        ];

        if (preg_match($cardTypes['VISA'] , $pan)) {
            return 'VIS';
        }

        if(preg_match($cardTypes['MAS'], $pan)) {
            return 'MAS';
        }

        return redirect()->back();
    }
}
