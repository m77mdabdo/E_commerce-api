<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function redirect()
    {

        if (Auth::user()->role == "admin") {
            return view('admin.home');
        } else {
            return view('user.home');
        }
    }
}