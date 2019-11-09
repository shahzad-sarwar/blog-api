<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
	public function __construct()
	{
		$this->middleware(['role:super-admin', 'auth:api']);
	}
    public function index()
    {
    	$roles = Role::latest()->select(['id', 'name'])->paginate(10);
    	return response()->json($roles);
    }
}
