<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
    public function rules($id)
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'staff_id' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id, 'id')],
            'roles' => 'required',
        ];
    }
}
