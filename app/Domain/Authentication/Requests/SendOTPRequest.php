<?php

namespace App\Domain\Authentication\Requests;

use App\Domain\Authentication\DTO\SendOTPDTO;
use App\Domain\Authentication\Rules\CheckEmailNotVerifiedRule;
use App\Domain\Authentication\Rules\CheckOTPIsExistRule;
use Illuminate\Foundation\Http\FormRequest;

class SendOTPRequest extends FormRequest
{
    private SendOTPDTO $dto;

    public function __construct(SendOTPDTO $dto)
    {
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
            'email' => ['required', 'email', new CheckEmailNotVerifiedRule(),
                    new CheckOTPIsExistRule()
            ],
        ];
    }

    public function getDTO(): SendOTPDTO
    {
        $dto = $this->dto;
        $dto->setEmail($this->input('email'));

        return $dto;
    }
}
