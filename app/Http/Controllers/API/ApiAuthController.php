<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    //

    public function register(Request $request)
    {
        $error = Validator::make($request->all(), [
            "name" => "required|string|max:250",
            "email" => "required|email",
            "password" => "required|string|confirmed",
        ]);

        if ($error->fails()) {
            return response()->json([
                "error" => $error->errors(),
            ], 301);
        }

        $password = bcrypt($request->password);
        $access_token = Str::random(64);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password,
            "access_token" => $access_token,
        ]);

        return response()->json([
            "msg" => "register successfully",
            "access_token" => $access_token,
        ], 201);
    }

   public function login(Request $request){
       //validator
        $error = Validator::make($request->all(), [

            "email" => "required|email",
            "password" => "required|string",
        ]);

        if ($error->fails()) {
            return response()->json([
                "error" => $error->errors(),
            ], 301);
        }

       //check email
       $email = $request->email;
       $user = User::where("email", $email)->first();
       $access_token = Str::random(64);
       if ($user) {

       //password check
        $isvale =  Hash::check($request->password,$user->password);
        if ($isvale) {
             //update access token
             $user->update([
                "access_token"=>$access_token,

             ]);
               return response()->json([
                "msg"=>"you login successfuly",
                "access_token"=> $access_token,
            ],201);

        }else{
            return response()->json([
                "msg"=>"credintails not correct password",
            ],201);
        }
       }else{
          return response()->json([
                "msg"=>"credintails not correct email",
            ],301);

      }


       //msg with access token



   }

   public function logout(Request $request){
        $access_token = $request->header('access_token');
        if($access_token != null){
            $user = User::where('access_token', $access_token)->first();
            if($user){

                $user->update([
                    'access_token'=> null ,

                ]);
                return response()->json([
                    'msg'=> 'you logout successfuly',
                ],200);

            }else{
                return response()->json([
                    "msg"=>"access token not correct",
                ],301);
            }

        }else{

            return response()->json([
                "msg"=>"credintails not correct access_token",
            ],301);

        }



   }

//    public function logout(Request $request)
// {
//     $accessToken = $request->header('access_token');

//     if (!$accessToken) {
//         return response()->json([
//             "msg" => "Access token is required."
//         ], 401); // Unauthorized
//     }

//     // ابحث عن المستخدم الذي يمتلك هذا التوكن
//     $user = User::where('access_token', $accessToken)->first();

//     if (!$user) {
//         return response()->json([
//             "msg" => "Invalid access token."
//         ], 401); // Unauthorized
//     }

//     // حذف التوكن وتسجيل الخروج
//     $user->update([
//         'access_token' => null
//     ]);

//     return response()->json([
//         'msg' => 'Logged out successfully.'
//     ], 200);
// }




}
