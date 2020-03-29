<?php

namespace App\Http\Controllers;

use App\Giving;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
     * @param Request $request
     * @return Response
     * @throws ValidationException
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
            'partnership_arms' => 'nullable'
        ]);

        if ($attributes['partnership_arms'] !== null) {
            $attributes['giving_option'] = $attributes['giving_option'] .' - '. $attributes['partnership_arms'];
        }

        $slug = Carbon::today()->format('dmyg') . bin2hex(random_bytes(5)) . Str::slug($request->full_name);

        $giving = Giving::create($attributes +
            [
                'transaction_id' => $this->transactionId(),
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

    /**
     * @param Request $request
     * @param PaymentService $paymentService
     * @return RedirectResponse
     */
    public function mobileMoneyPayment(Request $request, PaymentService $paymentService)
    {
        $response = $paymentService->mobileMoneyPayment($request);

        if ($response->code == '000') {

            Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => $response->status]);
            return redirect()->route('giving.successful');

        } else {
            Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => $response->status]);
            return redirect()->route('giving.error');
        }

    }

    /**
     * Method to send request to Payswitch Api Service
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function cardPayment(Request $request, PaymentService $paymentService)
    {
        $response = $paymentService->cardPayment($request);

        if ($response->code == '200' && $response->status == 'vbv required') {
            Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => 'Pending']);
            return redirect()->away($response->reason);

        } elseif ($response->code === '000') {
            Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => $response->status]);
            return redirect()->route('giving.successful');
        } else {
            Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => $response->status]);
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


    public function successful()
    {
        return view('pages.givings.confirmation');
    }

    public function errorState()
    {
        return view('pages.givings.declined');
    }
}
