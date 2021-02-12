<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

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
}
