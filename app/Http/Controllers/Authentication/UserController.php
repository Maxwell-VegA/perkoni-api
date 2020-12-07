<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    
    public function __invoke(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => [
            'email' => $user->email,
            'username' => $user->username,

        ]]);
    }
}