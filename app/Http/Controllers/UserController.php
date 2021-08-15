<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Returns active users who have specific citizenship, by default 'AT'
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countryCode = $request->get('country', 'AT'); // iso2
        if ($request->has('country')) {
            $countryCode = strtoupper($countryCode);
        }
        // do not accept empty value
        if (empty($countryCode)) {
            return response()->json([
                'error' => [
                    'message' => 'country is required',
                ]
            ], 400);
        }

        // @todo create resources, return resource with relationships
        return User::with('detail', 'detail.country')
            ->where('active', '=', 1)
            ->whereHas(
                'detail.country', function($q) use($countryCode) {
                    $q->where('iso2', $countryCode);
                }
            )
            ->get();
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
