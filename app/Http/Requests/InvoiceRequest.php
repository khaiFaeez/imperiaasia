<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'shipping.Ship_Name' => 'required',
            'client' => 'required ',
            'payment.items.0.ptp' => 'required',
            'sales.consultant' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'payment.items.0.ptp.required' => 'Please add first Promise-To-Pay ',
            'sales.consultant.required' => 'Please specify a consultant',
        ];
    }
}
