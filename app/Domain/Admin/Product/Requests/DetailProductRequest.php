<?php

namespace App\Domain\Admin\Product\Requests;

use App\Common\Auth\AuthApi;
use App\Common\Enums\Role;
use App\Domain\Admin\Product\DTO\DetailProductDTO;
use App\Domain\Admin\Product\Rules\CheckProductExistRule;
use Illuminate\Foundation\Http\FormRequest;

class DetailProductRequest extends FormRequest
{

    private DetailProductDTO $dto;

    public function __construct(
        DetailProductDTO $dto
    ) {
        $this->dto = $dto;
        parent::__construct();
    }

    public function authorize(): bool
    {
        return AuthApi::checkAuth(
            [Role::ADMIN->value]
        );
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

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }

    public function getDto(): DetailProductDTO
    {
        $dto = $this->dto;
        $dto->setId($this->route('id'));
        return $dto;
    }
}