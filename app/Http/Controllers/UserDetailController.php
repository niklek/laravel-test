<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * Implemented via User model, with loading detail, but can be done via UserDetail
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $userId, int $id)
    {
        // payload validation, on error, return first error
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'user_id' => 'required|integer',
            'citizenship_country_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|min:14|max:14',
        ]);
        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json([
                'error' => [
                    'message' => $validator->errors()->first(),
                ]
            ], 400);
        }

        // load the user, check if exists
        $user = User::with('detail')->find($userId);
        if (!$user) {
            return response()->json([
                'error' => [
                    'message' => 'User not found',
                ]
            ], 404);
        }

        // check if the user detail exists
        if (!$user->detail) {
            return response()->json([
                'error' => [
                    'message' => 'User detail not found',
                ]
            ], 404);
        }

        // make sure user detail is is correct
        if ($user->detail->id !== $id) {
            return response()->json([
                'error' => [
                    'message' => 'Bad user detail id',
                ]
            ], 400);
        }

        // update user details
        if (!$user->detail->update($request->all())) {
            return response()->json([
                'error' => [
                    'message' => 'Failed to update user detail',
                ]
            ], 500);
        }

        return $user->detail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
