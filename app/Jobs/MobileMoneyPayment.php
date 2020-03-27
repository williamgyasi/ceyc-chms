<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MobileMoneyPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;


    /**
     * Create a new job instance.
     *
     * @param Request $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @param $request
     * @return void
     */
    public function handle()
    {
        $uri = 'https://prod.theteller.net/v1.1/transaction/process';

        $amount = sprintf("%'.012d", $this->request['amount'] * 100);

        $body = [
            'amount' => $amount,
            'processing_code' => '000200',
            'transaction_id' => $this->request['transaction_id'],
            'desc' => 'CEYC AC Giving',
            'merchant_id' => "TTM-00000086",
            'subscriber_number' => $this->request['contact'],
            'r-switch' => $this->request['mobile_network'],
            'voucher_code' => $this->request['voucher_code'],
        ];


        $client = new Client();

        $response = $client->request('POST', $uri, [
           'headers' => $this->headers(),
           'body' => json_encode($body),
           'timeout' => 120
        ]);

        dd($response->getBody()->getContents());
    }

    private function headers() : array
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
}
