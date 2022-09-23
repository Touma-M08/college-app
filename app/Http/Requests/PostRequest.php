<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
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

    public function rules(Request $request)
    {
        return [
            'post.title' => 'required',
            'post.problem' => 'required',
            'post.solution' => 'required',
            'image.*' => 'image'
        ];
    }
}
