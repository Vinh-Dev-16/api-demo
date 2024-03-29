<?php

namespace App\Domain\Admin\Product\Rules;

use App\Common\Enums\SoftDelete;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckProductExistRule implements Rule
{

    public function passes($attribute, $value)
    {
        return Product::query()
            ->where('id', $value)
            ->where('is_deleted', SoftDelete::ACTIVE->value)
            ->exists();
    }

    public function message(): string
    {
        return 'The product does not exist.';
    }
}