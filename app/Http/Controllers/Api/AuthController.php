<?php

namespace App\Http\Controllers\Api;

use App\Enums\ErrorTypeEnum;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (! Auth::guard('web')->attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized.',
                'type' => ErrorTypeEnum::INCORRECT_PASSWORD
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => UserResource::make($user),
                'token' => $token
            ]
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $user = User::query()->create($credentials);
        $token = $user->createToken('MyApp')->plainTextToken;

        $user->assignRole(RoleEnum::USER);

        return response()->json([
            'data' => [
                'user' => UserResource::make($user),
                'token' => $token
            ]
        ], 201);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json(null, 204);
    }
}
