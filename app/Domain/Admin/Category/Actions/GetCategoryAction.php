<?php

namespace App\Domain\Admin\Category\Actions;

use App\Domain\Admin\Category\DTO\ListCategoryDTO;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class GetCategoryAction
{
    public function handle(ListCategoryDTO $dto): LengthAwarePaginator
    {
        return Category::query()
            ->orderBy('id', 'desc')
            ->with('products')
            ->paginate($dto->getLimit(), ['*'], 'page', $dto->getPage());
    }
}