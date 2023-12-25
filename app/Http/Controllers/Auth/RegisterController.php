<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // hachage mdp

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            //'name' => 'required',
            'email' => 'required|email|unique:users,email', // mail unique
            'password' => 'required|min:6', // au moin 6 caractaire
            'type_user'=> 'required',
            'ville_user'=> 'required',
            'adresse_user'=> 'required',
            'image_user'=>'required'
        ]);
        $user = User::create([
            // 'name' => $request->name,
            'image_user'=>$request->image_user,
            'email' => $request->email,
            'type_user'=> $request->type_user,
            'ville_user'=> $request->ville_user,
            'adresse_user'=> $request->adresse_user,
            'password' => Hash::make($request->password), // lezmou ikoun hash
        ]);
       // $token = $user->createToken('token-name')->plainTextToken; // zeydaa
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'id'=>$user->id
           // 'token' => $token
        ], 200);
    }
}
