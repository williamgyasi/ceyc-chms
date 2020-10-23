<?php

namespace App\Http\Controllers;

use Exception;
use App\Giving;
use App\Http\Requests\CardPaymentRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Payment\MobileMoneyPaymentRequest;

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
     * @return RedirectResponse
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

        if ($response->code == 000) {
            Giving::whereTransactionId($request->transaction_id)
                ->update(['payment_status' => $response->status]);
            return redirect()->route('giving.successful');

        }

        Giving::whereTransactionId($request->transaction_id)
            ->update(['payment_status' => $response->status]);
        return redirect()->route('giving.error');
    }

    /**
     * Method to send request to Payswitch Api Service
     *
     * @param CardPaymentRequest $request
     * @return RedirectResponse
     */
    public function cardPayment(CardPaymentRequest $request, PaymentService $paymentService)
    {
        $transactionId = $this->transactionId();

        Giving::create($request->validated() + [
            'transaction_id' => $transactionId,
            'slug' => $this->slug($request)
            ]);

        $response = $paymentService->cardPayment($request->validated() + [
            'transaction_id' => $transactionId
        ]);

        if ($response->code === 200 && $response->status == 'vbv required') {
            Giving::whereTransactionId($response->transaction_id)
                ->update(['payment_status' => 'Pending']);
            return redirect()->away($response->reason);
        }

        if ($response->code === 000) {
            Giving::whereTransactionId($response->transaction_id)
                ->update(['payment_status' => $response->status]);
            return redirect()->away($response->reason);
        }

        Log::error("Giving failed with code of {$response->code}, Status {$response->status} and Reason {$response->reason}");
        Giving::whereTransactionId($response->transaction_id)
            ->update(['payment_status' => $response->status]);

        return redirect()->route('giving.error');
    }

    /**
     * Method to generate  random transactionId
     * of 12 digits
     *
     * @return string
     */
    protected function transactionId(): string
    {
        $shuffled = str_shuffle((String)round(microtime(true) * 568));
        return substr($shuffled, 0, 12);
    }

    protected function  slug(Request $request) : string
    {
        return
            Carbon::today()->format('dmyg')
            . bin2hex(random_bytes(5))
            . Str::slug($request->full_name);
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
