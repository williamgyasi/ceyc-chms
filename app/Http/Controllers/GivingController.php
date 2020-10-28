<?php

namespace App\Http\Controllers;

use Exception;
use App\Giving;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CardPaymentRequest;
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
        return view('pages.givings.dashboard', [
            'givings' => Giving::get(),
            'currentDayGivings' => Giving::madeOnCurrentDay()->get(),
            'approvedGivings' => Giving::approvedGivings()->get(),
            'declinedGivings' => Giving::declinedGivings()->get(),
            'failedGivings' => Giving::failedGivings()->get()
        ]);
    }

    public function search(Request $request)
    {
       return view('pages.givings.search-results', [
            'givings' =>  Giving::filter(
                $request->only('status', 'start_date', 'end_date', 'reference')
                )->get()
       ]);
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

        $giving = Giving::create($attributes +
            [
                'transaction_id' => $this->transactionId(),
                'slug' => $this->slug($request)
            ]);

        return redirect()->route('giving.confirm', compact('giving'));
    }

    public function confirm(Giving $giving)
    {
        return view('pages.givings.confirm', [
            'giving' => $giving
        ]);
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
        }

        Giving::whereTransactionId($request->transaction_id)
            ->update(['payment_status' => $response->status]);
        return redirect()->route('giving.error');
    }

    /**
     * Method to send request to Payswitch Api Service
     *
     * @param CardPaymentRequest $request
     * @param PaymentService $paymentService
     * @return RedirectResponse
     */
    public function cardPayment(CardPaymentRequest $request, PaymentService $paymentService)
    {
        $response = $paymentService->cardPayment($request->validated());

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

    protected function createSlug($fullName)
    {
        return Carbon::today()->format('dmyg') .
            bin2hex(random_bytes(5)) . Str::slug($fullName);
    }
}
