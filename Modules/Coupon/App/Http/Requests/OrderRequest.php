<?php

namespace Modules\Coupon\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'fname'        => ['required'],
            'lname'        => ['required'],
            'phone'        => ['required'],
            'email'        => ['required'],
            'house_number' => ['required'],
            // 'city'         => ['required'],
            // 'state'        => ['required'],
            // 'zip'          => ['required'],
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
