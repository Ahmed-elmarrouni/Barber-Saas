<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\login;
use App\Http\Requests\Auth\register;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(register $request)
    {
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input("password"));
        $user->save();
        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return  response()->json([ 'user' => $user,
            'token' => $token,]);

    }

    public function login(login $request)
    {
        $user = User::where('email',$request->input("email"))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
           return  response()->json(['message'=>'wrong credentials']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;


        return  response()->json([   'user' => $user,
            'token' => $token,]);

    }
}
