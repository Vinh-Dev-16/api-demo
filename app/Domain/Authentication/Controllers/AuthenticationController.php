<?php

namespace App\Domain\Authentication\Controllers;

use App\Domain\Authentication\Features\LoginFeature;
use App\Domain\Authentication\Features\RegisterFeature;
use App\Domain\Authentication\Features\SendOTPFeature;
use App\Domain\Authentication\Features\VerifyEmailFeature;
use App\Domain\Authentication\Requests\LoginRequest;
use App\Domain\Authentication\Requests\RegisterRequest;
use App\Domain\Authentication\Requests\SendOTPRequest;
use App\Domain\Authentication\Requests\VerifyEmailRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function __construct(
        Request                      $request,
        protected RegisterFeature    $registerFeature,
        protected SendOTPFeature     $getOtpFeature,
        protected VerifyEmailFeature $verifyEmailFeature,
        protected LoginFeature       $loginFeature
    ) {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @throws \Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        $this->registerFeature->setDto($dto);
        $this->registerFeature->handle();

        return response()->json(['message' => 'User registered successfully'], Response::HTTP_CREATED);
    }

    public function verifyByEmail(VerifyEmailRequest $request): JsonResponse
    {
        $dto = $request->getDTO();
        $this->verifyEmailFeature->setDto($dto);
        $this->verifyEmailFeature->handle();

        return response()->json(['message' => 'Email verified successfully'], Response::HTTP_OK);
    }

    /**
     * @throws \Exception
     */
    public function sendOPT(SendOTPRequest $request): JsonResponse
    {
        $dto = $request->getDTO();
        $this->getOtpFeature->setDto($dto);
        $data = $this->getOtpFeature->handle();
        return response()->json([
            'message' => 'OTP sent successfully',
            'data'    => $data
        ], Response::HTTP_OK);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $dto = $request->getDTO();
        $this->loginFeature->setDto($dto);
        $data = $this->loginFeature->handle();
        return response()->json([
            'message' => 'User logged in successfully',
            'data'    => $data
        ], Response::HTTP_OK);
    }
}
