<?php

namespace App\Domain\Authentication\Requests;

use App\Domain\Authentication\DTO\LoginDTO;
use App\Domain\Authentication\Rules\CheckEmailExistRule;
use App\Domain\Authentication\Rules\CheckEmailNotVerifiedRule;
use App\Domain\Authentication\Rules\CheckEmailVerifiedRule;
use App\Domain\Authentication\Rules\CheckIsCorrectPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    private LoginDTO $dto;

    public function __construct(LoginDTO $dto)
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
            'email' => ['required',
                'email',
                new CheckEmailExistRule(),
                new CheckEmailVerifiedRule(),
            ],
            'password' => ['required', 'string',
                'min:8',
                'max:255',
                new CheckIsCorrectPasswordRule(),
            ],
        ];
    }

    public function getDTO(): LoginDTO
    {
        $dto = $this->dto;
        $dto->setEmail($this->input('email'));
        $dto->setPassword($this->input('password'));

        return $dto;
    }
}
