<?php

namespace App\Domain\Authentication\Requests;

use App\Domain\Authentication\DTO\VerifyEmailDTO;
use App\Domain\Authentication\Rules\CheckEmailVerifiedRule;
use App\Domain\Authentication\Rules\CheckOTPIsCorrectRule;
use App\Domain\Authentication\Rules\CheckOTPIsExpiredRule;
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
            'email' => [
                'required',
                'email',
                new CheckEmailVerifiedRule()
            ],
            'otp'   => [
                'required',
                'string',
                'min:6',
                'max:6',
                'regex:/^[0-9]*$/',
                new CheckOTPIsCorrectRule($this->get('email') ?? ''),
                new CheckOTPIsExpiredRule($this->get('email') ?? ''),
            ],
        ];
    }

    public function getDTO(): VerifyEmailDTO
    {
        $dto = $this->dto;
        $dto->setEmail($this->input('email'));

        return $dto;
    }
}
