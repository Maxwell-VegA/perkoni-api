<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// Illuminate\Auth\AuthManager
use Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function google()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function googleRe()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'username' => $user->name,
            'password' => Hash::make(Str::random(24)),
        ]);
            
        // $user = auth()->setToken(auth()->fromUser($user));
        // $user = auth()->fromUser($user);
        // auth()->authenticate();

        Auth::login($user, true);
        
        // $token = auth()->authenticate();
        // return response()->json(compact('token'));
        return redirect('http://localhost:3000/');
        // return redirect('http://localhost:3000/login&token=' . auth()->fromUser($user));
        // json(compact('token'));
        // return redirect('http://localhost:3000/login?token=' . auth()->fromUser($user));
        
        
        // Auth::login($user, true);
        
        // if (!$token = auth()->attempt($user->only('email', 'password'))) {
        //     return response(null, 401);
        // }
        
        // return response()->json(compact('token'));
        
        return redirect('http://localhost:3000/products/');
    }
}