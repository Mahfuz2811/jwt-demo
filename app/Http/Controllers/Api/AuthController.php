<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Tymon\JWTAuth\Facades\JWTAuth;

use Exception;

class AuthController extends Controller
{
	public function __construct()
    {
        $this->middleware('jwt-auth')->only(['check']);
        //$this->middleware('jwt.refresh')->only(['refresh']);
    }

    public function login(Request $request) 
    {
	    $credentials = $request->only(['email', 'password']);
	    if (!$token = auth('api')->attempt($credentials)) {
	        return response()->json(['error' => 'Unauthorized'], 401);
	    }
	    return response()->json([
	    	'is_success' => true,
	        'token' => $token,
	        'expires' => auth('api')->factory()->getTTL() * 60,
	    ]);
	}

	public function refresh(Request $request) 
    {
	    try {

	    	$token 		= JWTAuth::getToken();
	    	$newToken 	= JWTAuth::refresh($token);

	    	//$newToken = auth()->refresh();

	    } catch (Exception $e) {

	    	return response()->json([
	    		'is_success' => false,
	    		'error' => $e->getMessage()
	    	], 401);
	    }

	    return response()->json([
	    	'is_success' => true,
	        'token' => $newToken,
	        'expires' => auth('api')->factory()->getTTL() * 60,
	    ]);
	}

	public function check()
	{
		return response()->json([
			'is_success' => true,
			'message' => 'Success'
		], 201);
	}
}
