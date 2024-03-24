<?php


namespace App\Domain\Authentication\Controllers;

use App\Domain\Authentication\Features\RegisterFeature;
use App\Domain\Authentication\Features\SendOTPFeature;
use App\Domain\Authentication\Requests\SendOTPRequest;
use App\Domain\Authentication\Requests\RegisterRequest;
use App\Domain\Authentication\Requests\VerifyEmailRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function __construct(
        Request                   $request,
        protected RegisterFeature $registerFeature,
        protected SendOTPFeature   $getOtpFeature,
    ) {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        $this->registerFeature->setDto($dto);
        $this->registerFeature->handle();
        return response()->json(['message' => 'User registered successfully'], Response::HTTP_CREATED);
    }

    public function verifyByEmail(VerifyEmailRequest $request)
    {
    }

    public function sendOPT(SendOTPRequest $request): JsonResponse
    {
        $dto = $request->getDTO();
        $this->getOtpFeature->setDto($dto);
        $this->getOtpFeature->handle();
        return response()->json([
            'message' => 'OTP sent successfully',
        ], Response::HTTP_OK);
    }

    public function login(Request $request): JsonResponse
    {
        return response()->json(['message' => 'User logged in successfully'], Response::HTTP_OK);
    }
}