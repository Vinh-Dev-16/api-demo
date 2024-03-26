<?php

namespace App\Domain\Admin\Product\Actions;

use App\Common\Enums\SoftDelete;
use App\Domain\Admin\Product\DTO\ListProductDTO;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class GetProductAction
{
    public function handle(ListProductDTO $dto): LengthAwarePaginator
    {
        return Product::query()
            ->where('is_deleted', SoftDelete::ACTIVE->value)
            ->orderBy('id', 'desc')
            ->when($dto->isKeyWordExist(), function ($query) use ($dto) {
                $query->where('name', 'like', '%'.$dto->getKeyword().'%')
                    ->orWhere('description', 'like', '%'.$dto->getKeyword().'%')
                    ->orWhere('price', 'like', '%'.$dto->getKeyword().'%');
            })
            ->paginate($dto->getLimit(), '*', 'page', $dto->getPage());
    }
}