<?php

namespace App\Domain\Admin\Category\Requests;

use App\Common\Rules\LimitRule;
use App\Common\Rules\PageRule;
use Illuminate\Foundation\Http\FormRequest;

class ListCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page'    => ['nullable', 'integer', new PageRule()],
            'limit'   => ['nullable', 'integer', new LimitRule()],
            'keyWord' => ['nullable', 'string']
        ];
    }

}