<?php

namespace Modules\Coupon\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $roles =  [
            'name'            => ['required'],
            'discount_amount' => ['required'],
            'type'            => ['required'],
            'status'          => ['required'],
        ];
        if (request()->update_id) {
            $roles['code']  = ['required', 'max:255'];
        } else {
            $roles['code']  = ['required', 'unique:coupons,code', 'max:255'];
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
