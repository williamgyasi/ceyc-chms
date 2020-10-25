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
            'full_name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'giving_option' => ['required', 'string'],
            'partnership_arms' => ['nullable', 'string'],
            'pan' => ['required', 'string'],
            'card_holder' => ['required',  'string'],
            'exp_month' => ['required', 'string'],
            'exp_year' => ['required', 'string'],
            'cvv' => ['required', 'string']
        ];
    }
}
