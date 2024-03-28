<?php

namespace App\Domain\Admin\Product\Features;

use App\Domain\Admin\Product\Actions\GetProductAction;
use App\Domain\Admin\Product\DTO\DetailProductDTO;
use App\Domain\Admin\Product\Transformers\DetailProductTransformer;

class DetailProductFeature
{
    private DetailProductDTO $dto;

    public function __construct(
        protected GetProductAction $getProductAction,
        protected DetailProductTransformer $detailProductTransformer
    )
    {
    }

    public function setDto(DetailProductDTO $dto): void
    {
        $this->dto = $dto;
    }


    public function handle(): array
    {
        $dto = $this->dto;
        $product = $this->getProductAction->byId($dto->getId());
        $this->detailProductTransformer->setProduct($product);
        return $this->detailProductTransformer->single();
    }
}