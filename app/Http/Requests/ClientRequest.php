<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'MyKad_SSM' => [
                'required',
                Rule::unique(Auth::user()->current_portfolio()->first()->db_connection . '.Client', 'MyKad_SSM')->ignore($this->id),
            ],
            'Name' => 'required',
            'Mobile_No' => [
                'required',
                'numeric',
                Rule::unique(Auth::user()->current_portfolio()->first()->db_connection . '.Client', 'Mobile_No')->ignore($this->id)
            ],
            'Address' => 'required',
            'Address_2' => 'required',
            'Poscode' => 'required',
            'City' => 'required',
            'State' => 'required',
            'Country' => 'required'
        ];
    }
}
