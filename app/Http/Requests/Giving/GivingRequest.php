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

    public function all($keys = null)
    {
        $requestData = parent::all();

        if ($requestData['partnership_arms']) 
        {
            $requestData['giving_option'] = $requestData['giving_option'] . ' - ' 
                . $requestData['partnership_arms'];
        }
        return $requestData;
    }
}
