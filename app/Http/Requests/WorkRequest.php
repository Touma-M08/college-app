<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
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
            'work.title' => 'required',
            'work.summary' => 'max:200',
            'work.language' => 'max:100',
            'work.url' => 'max:255',
            'work.github' => 'max:255',
            'image' => 'image'
        ];
    }
}
