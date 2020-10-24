<?php

namespace App\Http\Controllers;

use App\Giving;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CardPaymentRequest;
use App\Http\Requests\Payment\MobileMoneyPaymentRequest;
use App\Services\PayswitchPaymentService;


class V2GivingController extends Controller
{
    public function create()
    {
        return view('pages.givings.v2.step-2');
    }

    public function cardGiving(CardPaymentRequest  $request, PayswitchPaymentService $paymentService)
    {
        $transactionId = $this->transactionId();

        Giving::create($request->validated() + [
            'transaction_id' => $transactionId,
             'slug' => $this->slug($request)
            ]);
        
        $response = $paymentService->cardPayment($request->validated() + [
            'transaction_id' => $transactionId
            ]);
        
        if ($response->code == '200' && $response->status == 'vbv required')
        {
            Giving::whereTransactionId($transactionId)
                ->update(['payment_status' => $response->status]);
            return redirect()->away($response->reason);
        }

        if ($response->status == '000')
        {
            Giving::whereTransactionId($transactionId)
                ->update(['payment_status' => $response->status]);
            return redirect()->route('giving.successful');
        }

        Log::error("Giving failed with code of $response->code Status {$response->status} and Reason {$response->reason}");
        Giving::whereTransactionId($transactionId)
            ->update(['payment_status' => $response->status]);
        return redirect()->route('giving.error');
    }

    public function  mobileMoneyGiving(MobileMoneyPaymentRequest $request, PayswitchPaymentService $paymentService)
    {
        $transactionId = $this->transactionId();

        Giving::create($request->validated() + [
            'transaction_id' => $transactionId,
            'slug' => $this->slug($request)
        ]);

        $response = $paymentService->mobileMoneyPayment($request->validated() + [
            'transaction_id' => $transactionId
        ]);
        
        if ($response->code == '000') {
            Giving::whereTransactionId($transactionId)
                ->update(['payment_status' => $response->status]);
            return redirect()->route('giving.successful');
        }

        Giving::whereTransactionId($transactionId)
            ->update(['payment_status' => $response->status]);
        return redirect()->route('giving.error');
    }

    protected function transactionId() : String
    {
        $shuffled = str_shuffle((String)round(microtime(true) * 568));
        return substr($shuffled, 0, 12);
    }

    protected function slug($request)
    {
        return
            Carbon::today()->format('dmyg')
            . bin2hex(random_bytes(5))
            . Str::slug($request->full_name);
    }
}
