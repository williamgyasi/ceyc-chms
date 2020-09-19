<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transaction_id' => ['required'],
            'amount' => ['required'],
            'customer_email' => ['required', 'email'],
            'pan' => ['required'],
            'card_holder' => ['required'],
            'exp_month' => ['required'],
            'exp_year' => ['required'],
            'cvv' => ['required']
        ];
    }
}
