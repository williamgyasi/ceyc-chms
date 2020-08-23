<?php

namespace App\Http\Requests\Giving;

use Illuminate\Foundation\Http\FormRequest;

class GivingRequest extends FormRequest
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
            'full_name' => ['required'],
            'email' => ['required', 'email'],
            'contact' => ['required'],
            'amount' => ['required'],
            'giving_option' => ['required'],
            'partnership_arms' => ['nullable']
        ];
    }

    /**
     * Manipulates the validated object to change the giving option
     * if the partnership arm parameter is present in the validated object
     *
     * @return array
     */
    public function validated()
    {
        $data = $this->validator->validated();

        if ($data['partnership_arms']) {
            return array_merge($data, [
                'giving_option' 
                    => $data['giving_option'] . ' - '. $data['partnership_arms']
            ]);
        }

        return $data;
    }
}
