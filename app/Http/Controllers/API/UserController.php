<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\UserStoreRequest;
use App\Http\Requests\API\Admin\UserUpdateRequest;
use App\Http\Resources\API\PrivateUserResource;
use App\Http\Resources\API\UserResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin', 'auth:api']);
    }

 public function index()
 {
    $users = User::latest()->paginate(10);
    return PrivateUserResource::collection($users);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'password'));
        $role = Role::FindOrFail($request->role_id);
        $user->assignRole($role);
        return new PrivateUserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return new PrivateUserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->only('name', 'email', 'password'));
        return new PrivateUserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 200);
    }
}
