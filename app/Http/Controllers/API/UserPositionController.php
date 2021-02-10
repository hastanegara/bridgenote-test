<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserPositionResource;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserPositionController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user_positions = UserPosition::with('user')->get();

        return $this->sendResponse(UserPositionResource::collection($user_positions), 'User Position retrieved successfully');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $validator = Validator::make($input, [
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive',
            'position' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        if (UserPosition::where('user_id', Auth::user()->id)->count() > 0) {
            return $this->sendError('Position for this user already exist', []);
        }

        $user_position = UserPosition::create($input);

        return $this->sendResponse(new UserPositionResource($user_position), 'User Position created successfully');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if ( ! $user_position = UserPosition::with('user')->find($id)) {
            return $this->sendError('User Position not found');
        }

        return $this->sendResponse(new UserPositionResource($user_position), 'User Position retrieved successfully');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserPosition $user_position
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, UserPosition $user_position)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $validator = Validator::make($input, [
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive',
            'position' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        if (UserPosition::where('user_id', Auth::user()->id)->count() == 0) {
            return $this->sendError('Position for this user not exist', []);
        }

        $user_position->user_id = $input['user_id'];
        $user_position->status = $input['status'];
        $user_position->position = $input['position'];

        $user_position->save();

        return $this->sendResponse(new UserPositionResource($user_position), 'User Position updated successfully');
    }

    public function destroy(UserPosition $user_position)
    {
        if (UserPosition::where('user_id', Auth::user()->id)->count() == 0) {
            return $this->sendError('Position for this user not exist', []);
        }

        $user_position->delete();

        return $this->sendResponse([], 'User Position deleted successfully');
    }
}
