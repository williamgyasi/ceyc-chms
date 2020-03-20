<?php

namespace App\Http\Controllers;

use App\Giving;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'full_name'     =>  'required',
            'email'         =>  'required',
            'contact'       =>  'required',
            'amount'        =>  'required',
            'giving_option' =>  'required',
        ]);

        $transactionId = random_int(10,100) .  bin2hex(random_bytes(5));

        $slug = Carbon::today()->format('dmyg') . bin2hex(random_bytes(5)) . Str::slug($request->full_name);

        $giving = Giving::create($attributes + ['transaction_id' => $transactionId, 'slug' => $slug]);

        if($giving->save()) {

            return redirect()->route('giving.confirm', compact('giving'));

        }else {
            return redirect()->back();
        }
    }

    public function confirm(Giving $giving)
    {
       return view('pages.givings.confirm', compact('giving'));
    }

    public function completion(Request $request)
    {
        $status = $request->status;

        $curl = curl_init();

        $transaction_id = $request->transaction_id;

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://test.theteller.net/v1.1/users/transactions/".$transaction_id."/status",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Merchant-Id: TTM-00000086"
        ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($request->status !== 'approved') {

            $giving = Giving::whereTransactionId($transaction_id)
            
                    ->update(['payment_status' => $status]);
            
            request()->session()->flash('error', 'Looks Like Something Went Wrong Please Try Again!');

            return redirect()->route('giving.error');
            
        } else {

            $giving = Giving::whereTransactionId($transaction_id)
            
                    ->update(['payment_status' => $status]);
            
            request()->session()->flash('success', 'Transaction Completed!');

            return redirect()->route('giving.successful');
        }
  
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
