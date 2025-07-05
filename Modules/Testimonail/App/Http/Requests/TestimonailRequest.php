<?php

namespace Modules\Testimonail\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'        => ['required'],
            'designation' => ['required'],
            'ratting'     => ['required', 'numeric', 'min:1', 'max:5'],
            'status'      => ['required'],
            'review'      => ['required'],
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
