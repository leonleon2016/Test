<?php

namespace App\Http\Requests;

use App\Rules\DepthCheckRule;
use App\Rules\JsonCheckRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RenderJsonRequest extends FormRequest
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
            'json' => ['required', new JsonCheckRule()],
            'depth'=> ['nullable', new DepthCheckRule()],
            'background'=> ['nullable']
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            "json.required" => "json necessary",
        ];
    }
}
