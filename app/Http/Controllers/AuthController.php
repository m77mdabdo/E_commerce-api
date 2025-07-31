<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
     public function createRegister()
    {
        return view('auth_commerce.register');
    }

    public function storeRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
        "name" => "required|string|max:255",
        "email" => "required|email|max:255|unique:users,email",
        "phone" => "required",
        "password" => "required|string|min:6|confirmed",
    ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data= $validator->validated();
        $data['password'] = bcrypt($request->password);



        User::create($data);
        return view('auth_commerce.login');

    }
    public function createLogin()
    {
        return view('auth_commerce.login');
    }

    public function storeLogin(Request $request)
    {

        $data = $request->validate([
            "email" => "required|email|max:255",
            "password" => "required|string|min:6",
        ]);

        $valid =   Auth::attempt(['email' => $request->email, 'password' => $request->password]);


        if ($valid) {
            $user =  User::select("name")->where("email", $request->email)->first();

            session()->flash("sucess", "welcome $user->name");

              return redirect()->route('home');

        } else {
            return redirect(route("register"));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('userHome'));
    }
}
