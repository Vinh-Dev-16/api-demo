<?php

namespace App\Domain\Admin\Category\Features;

use App\Domain\Admin\Category\Actions\GetCategoryAction;
use App\Domain\Admin\Category\DTO\ListCategoryDTO;

class ListCategoryFeature
{
    private ListCategoryDTO $dto;
    public function __construct(
        protected GetCategoryAction $getCategoryAction
    )
    {

    }

    public function setDto(ListCategoryDTO $dto): void
    {
        $this->dto = $dto;
    }

    public function handle()
    {
        $dto = $this->dto;
        $categories = $this->getCategoryAction->handle($dto);

    }

}