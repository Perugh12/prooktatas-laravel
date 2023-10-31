<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            # Minden adat ami a userben megtalálható
            $user = Auth::user();
            $success['token'] = $user->createToken('vueAdmin')->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }

        return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {
    }

    public function refresh()
    {
    }

    public function me()
    {
    }

    protected function respondWithToken(string $token)
    {
    }
}
