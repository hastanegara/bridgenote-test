<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @param $result
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    /**
     * @param $error
     * @param array $error_message
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $error_message = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error
        ];

        if ( ! empty($error_message)) {
            $response['data'] = $error_message;
        }

        return response()->json($response, $code);
    }
}
