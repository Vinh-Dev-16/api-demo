<?php

namespace App\Domain\Admin\Product\Requests;

use App\Common\Auth\AuthApi;
use App\Common\Enums\PaginateData;
use App\Common\Enums\Role;
use App\Common\Rules\LimitRule;
use App\Common\Rules\PageRule;
use App\Domain\Admin\Product\DTO\ListProductDTO;
use Illuminate\Foundation\Http\FormRequest;

class ListProductRequest extends FormRequest
{
    private ListProductDTO $dto;

    public function __construct(ListProductDTO $dto)
    {
        $this->dto = $dto;
        parent::__construct();
    }

    public function authorize(): bool
    {
        return AuthApi::checkAuth(
            [Role::USER->value]
        );
    }

    public function rules(): array
    {
        return [
            'page'    => ['nullable', 'integer', new PageRule()],
            'limit'   => ['nullable', 'integer', new LimitRule()],
            'keyWord' => ['nullable', 'string'],
        ];
    }

    public function getDto(): ListProductDTO
    {
        $dto = $this->dto;
        $dto->setPage($this->input('page') ?? PaginateData::PAGE->value);
        $dto->setLimit($this->input('limit') ?? PaginateData::LIMIT->value);
        $dto->setKeyWord($this->input('keyWord') ?? '');
        return $dto;
    }
}