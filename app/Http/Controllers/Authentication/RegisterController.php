<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    // public function __construct() {
    //     $this->middleware(['guest']);
    // }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'username'  => ['required', 'max:255'],
            'email'     => ['required', 'max:255', 'email'],
            'password'  => ['required']
            // 'password'  => ['required', 'confirmed']
        ]);

        User::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        
        // auth()->attempt($request->only('email', 'password'));
    }
}