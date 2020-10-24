<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class MobileMoneyPaymentRequest extends FormRequest
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
            'full_name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'giving_option' => ['required', 'string'],
            'partnership_arms' => ['nullable', 'string'],
            'mobile_money_number' => ['required', 'string'],
            'mobile_network' => ['required', 'string'],
            'voucher_code' => ['nullable', 'string']
        ];
    }
}
