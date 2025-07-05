<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //     return [
    //         'name'       => ['required'],
    //         'email'      => ['required', 'email'],
    //         'phone'      => ['required'],
    //         'address'    => ['required'],
    //         'product_id' => ['required'],
    //         'shipping'   => ['required'],
    //     ];
    // }

    public function rules()
    {
        return [
            'name'     => ['required'],
            'phone'    => ['required', 'regex:/^01[3-9]\d{8}$/'],
            'address'  => ['required','min:12'],
            'shipping' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'নামটি সঠিকভাবে লিখুন আবার!',
            'phone.required'    => 'আপনার ফোন নম্বর অবশ্যই প্রদান করতে হবে।',
            'phone.regex'       => 'নাম্বারটি ভূল! আপনার ১১ ডিজিটের সঠিক নম্বরটি দিন',
            'address.required'  => 'ডেলিভারীর ঠিকানা সঠিকভাবে লিখুন আবার!',
            'address.min'       => 'ডেলিভারীর ঠিকানাটি অন্তত ১২ অক্ষরের হতে হবে!',
            'shipping.required' => 'ডেলিভারী এরিয়া সঠিকভাবে লিখুন আবার!',
        ];
    }
}
