<?php

namespace Modules\Product\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $roles = [
            'name'               => ['required'],
            'productcategory_id' => ['required'],
            'price'              => ['required', 'numeric'],
            'discount_price'     => ['nullable', 'numeric', 'lt:price'],
            'product_image'      => ['nullable'],
            'status'             => ['required'],
            'short_description'  => ['required'],
            'description'        => ['required'],
            // 'product_location'   => ['required'],
            // 'producttype'        => ['required'],
        ];

        if (request()->update_id) {
            $roles['product_image'] = ['image', 'mimes:jpeg,png,jpg,gif'];
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
