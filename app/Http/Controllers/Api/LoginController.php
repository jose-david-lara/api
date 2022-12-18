<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;

//use App\Models\User;
//use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\Sanctum;



class LoginController extends Controller
{
    //

    public function login (Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'token' => $request->user()->createToken($request->name)->plainTextToken,
                'message' => 'success'
            ]);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ],401);


    }

    public function validateLogin (Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ]);
    }

}
