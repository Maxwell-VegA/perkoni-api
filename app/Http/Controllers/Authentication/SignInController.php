<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function __invoke(Request $request)
    {
        if ($request->token) {
            auth()->setToken($request->token);
            $user = auth()->authenticate();
            // if ($user) {
            //     return response()->json(compact('token'));
            // }
            
        } else {
            if (!$token = auth()->attempt($request->only('email', 'password'))) {
                // return response()->json(compact($request));
                return response(null, 401);
            }
        }

        return response()->json(compact('token'));
    }

}