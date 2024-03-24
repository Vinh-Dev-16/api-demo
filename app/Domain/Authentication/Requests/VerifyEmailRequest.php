<?php

namespace App\Domain\Authentication\Requests;

use App\Domain\Authentication\DTO\VerifyEmailDTO;
use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    private VerifyEmailDTO $dto;

    public function __construct(VerifyEmailDTO $dto)
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
            'email' => 'required|email',
            'otp' => 'required|string',
        ];
    }

    public function getDTO(): VerifyEmailDTO
    {
        $dto = $this->dto;
        $dto->setEmail($this->input('email'));

        return $dto;
    }
}
