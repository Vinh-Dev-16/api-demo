<?php

namespace App\Domain\Admin\Product\Features;

use App\Domain\Admin\Product\Actions\GetProductAction;
use App\Domain\Admin\Product\DTO\ListProductDTO;
use App\Domain\Admin\Product\Transformers\ListProductTransformer;

class ListProductFeature
{
    private ListProductDTO $dto;

    public function __construct(
        protected GetProductAction       $getProductAction,
        protected ListProductTransformer $listProductTransformer
    ) {
    }

    public function setDto(ListProductDTO $dto): void
    {
        $this->dto = $dto;
    }

    public function handle(): array
    {
        $dto      = $this->dto;
        $products = $this->getProductAction->handle($dto);
        $this->listProductTransformer->setListProduct($products);
        return $this->listProductTransformer->transform();
    }
}