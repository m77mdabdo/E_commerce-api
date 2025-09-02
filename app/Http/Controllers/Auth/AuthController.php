<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show Register Page
     */
    public function createRegister()
    {
        return view('auth_commerce.register');
    }

    /**
     * Handle Register
     */
    public function storeRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"     => "required|string|max:255",
            "email"    => "required|email|max:255|unique:users,email",
            "phone"    => "required",
            "password" => "required|string|min:6|confirmed",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        // تسجيل الدخول مباشرة بعد التسجيل
        Auth::login($user);

        return redirect()->route('home')->with('success', "Welcome {$user->name}");
    }

    /**
     * Show Login Page
     */
    public function createLogin()
    {
        return view('auth_commerce.login');
    }

    /**
     * Handle Login
     */
    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            "email"    => "required|email|max:255",
            "password" => "required|string|min:6",
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('home')->with("success", "Welcome {$user->name}");
        }

        return back()->withErrors([
            'email' => 'Invalid credentials, please try again.',
        ])->withInput();
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('userHome')->with("success", "You have been logged out.");
    }
}
