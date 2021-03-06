<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:user']);
    }
    
    public function __invoke(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => [
            'id' => $user->id,
            'email' => $user->email,
            'username' => $user->username,
            'is_vendor' => $user->is_vendor,
            'is_admin' => $user->is_admin,

        ]]);
    }
}