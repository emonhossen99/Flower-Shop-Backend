<?php

namespace Modules\Category\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $roles =  [
            'status'   => ['required'],
            'order_by' => ['required'],
        ];
        if (request()->update_id) {
            $roles['name']  = ['required', 'max:255'];
        } else {
            $roles['name']  = ['required', 'unique:categories,name', 'max:255'];
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
