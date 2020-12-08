<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignOutController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth:api']);
    // }
    
    public function __invoke()
    {
        auth()->logout();
    }
}