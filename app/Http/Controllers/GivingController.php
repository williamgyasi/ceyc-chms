<?php

namespace App\Http\Controllers;

use App\Giving;
use Carbon\Carbon;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log as Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\Debug\Exception\FatalErrorException;

class GivingController extends Controller
{
    /**
     * Method to display a listing of all giivngs/contributions
     */
    public function index()
    {
        //code goes here
    }

    /**
     * Method to display the form for giving
     */
    public function showGivingForm()
    {
        return view('pages.givings.create');
    }

    /**
     * Method to store a newly created giving resource to database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'amount' => 'required',
            'giving_option' => 'required',
        ]);

        $transactionId = $this->transactionId();

        $slug = Carbon::today()->format('dmyg') . bin2hex(random_bytes(5)) . Str::slug($request->full_name);


        $giving = Giving::create($attributes +
            [
                'transaction_id' => $transactionId,
                'slug' => $slug
            ]);

        if ($giving->save()) {

            return redirect()->route('giving.confirm', compact('giving'));

        } else {
            return redirect()->back();
        }
    }

    public function confirm(Giving $giving)
    {
        return view('pages.givings.confirm', compact('giving'));
    }

    public function mobileMoneyPayment(Request $request)
    {
        $uri = 'https://prod.theteller.net/v1.1/transaction/process';

        $amount = sprintf("%'.012d", $request->amount * 100);

        $body = [
            'amount' => $amount,
            'processing_code' => '000200',
            'transaction_id' => $request->transaction_id,
            'desc' => 'CEYC AC Giving',
            'merchant_id' => "TTM-00000086",
            'subscriber_number' => $request->contact,
            'r-switch' => $request->mobile_network,
        ];

        if ($request->mobile_network === 'VDF') {
            $body = Arr::add($body, 'voucher_code', $request->voucher_code);
        }

        $client = new Client();

        try {
            $response = $client->request('POST', $uri, [
                'headers' => $this->headers(),
                'body' => json_encode($body),
                'timeout' => 60
            ]);

            $responseBody = json_decode($response->getBody()->getContents());

            if ($responseBody->code == '000') {

                Giving::whereTransactionId($request->transaction_id)
                    ->update(['payment_status' => $responseBody->status]);

                request()->session()->flash('success', 'Transaction Completed!');

                return redirect()->route('giving.successful');

            } else {
                Giving::whereTransactionId($request->transaction_id)
                    ->update(['payment_status' => $responseBody->status]);

                request()->session()->flash('error', 'Looks Like Something Went Wrong. Please Try Again');

                return redirect()->route('giving.error');
            }

        } catch (ConnectException $exception) {
            Log::critical($exception->getResponse());
            return redirect()->route('giving.error');

        } catch (FatalErrorException $e) {
            Log::critical($e->getMessage());
            return redirect()->route('giving.error');
        }

    }

    /**
     * Builds the response headers to be used
     * for making API calls (GET/POST)
     *
     * @return array
     */
    public function headers(): array
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
     * Method to generate  random transactionId
     * of 12 digits
     *
     * @return string
     */
    public function transactionId(): string
    {
        $milliseconds = (String)round(microtime(true) * 568);
        $shuffled = str_shuffle($milliseconds);
        $transactionId = substr($shuffled, 0, 12);
        return $transactionId;
    }


    public function successful()
    {
        return view('pages.givings.confirmation');
    }

    public function errorState()
    {
        return view('pages.givings.declined');
    }
}
