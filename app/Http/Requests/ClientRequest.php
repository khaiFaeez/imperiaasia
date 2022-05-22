<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'MyKad_SSM' => 'required | digits:12 ',
            'Name' => 'required',
            'Mobile_No' => 'required | numeric',
            'Address' => 'required',
            'Address_2' => 'required',
            'Poscode' => 'required',
            'City' => 'required',
            'State' => 'required',
            'Country' => 'required'
        ];
    }
}
