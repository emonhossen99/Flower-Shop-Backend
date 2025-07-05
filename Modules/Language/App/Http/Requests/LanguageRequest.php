<?php

namespace Modules\Language\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('languages', 'name')->ignore($this->route('id')),
            ],
            'code'      => [
                'required',
                Rule::unique('languages', 'code')->ignore($this->route('id'))],
            'direction' => ['required'],
            'status'    => ['required'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
