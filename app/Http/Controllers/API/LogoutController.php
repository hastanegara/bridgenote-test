<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class LogoutController extends BaseController
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->token()->revoke()) {
            return $this->sendResponse([], 'User logged out successfully');
        }
    }
}
