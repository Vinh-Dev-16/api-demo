<?php

namespace App\Domain\Admin\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                new CheckProductExistRule()
            ]
        ];
    }
}