<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Returns only active users who have given citizenship, by default AT
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $country = $request->get('country', 'AT'); // iso2
        if ($request->has('country')) {
            $country = strtoupper($country);
        }
        
        if (empty($country)) {
            // @todo handle case
        }

        return User::with('userDetails', 'userDetails.country')
            ->where('active', '=', 1)
            ->whereHas(
                'userDetails.country', function($q) use($country) {
                    $q->where('iso2', $country);
                }
            )
            ->get();
    }

    public function editDetails()                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
    {
        return 'Edit details';
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
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
