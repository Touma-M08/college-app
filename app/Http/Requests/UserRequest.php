<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;


class UserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'users.name' => 'required',
            'users.email' => ["required", "string", "email", "max:255",
                Rule::unique('users')->ignore(Auth::id())]
        ];
    }
}
