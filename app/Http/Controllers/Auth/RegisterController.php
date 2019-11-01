<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\API\PrivateUserResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\assignRole;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
    	$user = User::create($request->only('name', 'email', 'password'));
    	$user->assignRole('user');
    	return new PrivateUserResource($user);
    }
}
