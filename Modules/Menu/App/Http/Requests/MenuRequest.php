<?php

namespace Modules\Menu\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'     => ['required'],
            'url'      => ['required'],
            'target'   => ['required'],
            'order_by' => ['required'],
            'status'   => ['required'],
            'position' => ['required'],
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
