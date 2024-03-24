<?php

namespace App\Domain\Authentication\Requests;

use App\Domain\Authentication\DTO\RegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    private RegisterDTO $dto;

    public function __construct(RegisterDTO $dto)
    {
        $this->dto = $dto;
        parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
    }

    public function getDto(): RegisterDTO
    {
        $dto = $this->dto;
        $dto->setUsername($this->input('username'));
        $dto->setEmail($this->input('email'));
        $dto->setPassword($this->input('password'));

        return $dto;
    }
}
