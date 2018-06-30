<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $claims = ['type' => 'developer', 'email' => $credentials['email']];

        try {
            //if (! $token = JWTAuth::claims($claims)->attempt($credentials)) {
            if (! $token = JWTAuth::attempt($credentials, $claims)) {
                return $this->respondForUnauthorizedRequest('Invalid email or password');
            }
        } catch (JWTException $e) {

            return $this->respondInternalError('Token exception');
        }

        // all good so return the token
        // auth()->user()->setJWT($token);

        return $this->respond([
            'token' => $token
        ]);
    }

}
