<?php

namespace App\Http\Controllers;

use App\Giving;
use App\Services\PaymentService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GivingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Method to display a listing of all givings/contributions
     */
    public function index()
    {
        $payments = Giving::get();

        $currentDayPayments = Giving::whereDate('created_at', Carbon::today())
                                    ->get();

        $approvedPayments = Giving::approvedGivings()->get();

        $declinedPayments = Giving::declinedGivings()->get();

        $otherPayments = Giving::failedGivings()->get();

        return view('pages.givings.dashboard',
            compact('payments', 'approvedPayments',
                'declinedPayments', 'otherPayments', 'currentDayPayments'));
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
     * @throws Exception
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

        return redirect()->route('giving.confirm', compact('giving'));
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
     * @param PaymentService $paymentService
     * @return RedirectResponse
     */
    public function cardPayment(Request $request, PaymentService $paymentService)
    {
        $response = $paymentService->cardPayment($request);
     
        if ($response->code == '200' && $response->status == 'vbv required') {
            Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => 'Pending']);
            return redirect()->away($response->reason);
        } 
        
        if ($response->code === '000') {
            Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => $response->status]);
            return redirect()->route('giving.successful');
        }

        Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => $response->status]);
            return redirect()->route('giving.error');
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

    /**
     * Method to handle redirection after VBV processing
     * for card payments.
     * @param Request $request
     */
    public function vbvConfirmation(Request $request)
    {
        if ($request->code === '000') {
            Giving::whereTransactionId($request->transaction_id)
                    ->update(['payment_status' => $request->status]);
            return redirect()->route('giving.successful');
        }

        Giving::whereTransactionId($request->transaction_id)
                    ->update(['payment_status' => $request->status]);
            return redirect()->route('giving.error');
    }
}
