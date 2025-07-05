<?php

namespace Modules\Order\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $roles =  [
            'customername'  => ['required'],
            'customerphone' => ['required'],
            'address'       => ['required'],
        ];

        if (request()->couriertype == 'Pathau') {
            $roles['selectcity']  = ['required'];
            $roles['selectzone']  = ['required'];
        }
        return $roles;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
