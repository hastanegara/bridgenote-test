<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('bridgenote')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User login successfully');
        }
        else {
            return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()->token()->revoke()) {
            return $this->sendResponse([], 'User logged out successfully');
        }
    }
}
