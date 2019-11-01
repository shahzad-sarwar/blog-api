<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
	{
		if (!$token = auth()->attempt($request->only('email', 'password'))) {
			
			return response()->json([
				'errors' => 'Wrong Credidentials'
			], 422);

		}

		return (new PrivateUserResource($request->user()))
		->additional([
			'meta' => [
				'token' => $token
			]
		]);
	}
}
