<?php

namespace App\Domain\Admin\Category\Requests;

use App\Common\Rules\LimitRule;
use App\Common\Rules\PageRule;
use App\Domain\Admin\Category\DTO\ListCategoryDTO;
use Illuminate\Foundation\Http\FormRequest;

class ListCategoryRequest extends FormRequest
{
    private ListCategoryDTO $dto;

    public function __construct(
        ListCategoryDTO $dto
    ) {
        $this->dto = $dto;
        parent::__construct();
    }


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

    public function getDto(): ListCategoryDTO
    {
        $dto = $this->dto;
        $dto->setPage($this->input('page'));
        $dto->setLimit($this->input('limit'));
        $dto->setKeyWord($this->input('keyWord'));
        return $dto;
    }

}