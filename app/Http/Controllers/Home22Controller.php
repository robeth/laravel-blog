<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class Home22Controller extends Controller
{

    public function create(Request $request)
    {
        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $request
         * @return \Illuminate\Contracts\Validation\Validator
         */
        $valid = validator($request->only('email', 'name', 'password', 'mobile'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'mobile' => 'required',
        ]);

        if ($valid->fails()) {
            $jsonError = response()->json($valid->errors()->all(), 400);
            return \Response::json($jsonError);
        }

        $data = request()->only('email', 'name', 'password', 'mobile');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'mobile' => $data['mobile']
        ]);


        return $user;
    }
}
