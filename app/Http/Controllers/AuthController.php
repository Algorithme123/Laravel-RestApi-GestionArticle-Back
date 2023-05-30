<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function register(Request $request){
        $fields= $request -> validate([
            'nom'=> 'required | string',
            'prenom' => 'required | string',
            'telephone' => 'required | string',
            'email' => 'required |string | unique:users,email',
            'password' => 'required | string | confirmed',
        ]);

        $user = User::create([
            'nom' => $fields['nom'] ,
            'prenom'  => $fields['prenom'],
            'telephone'  => $fields['telephone'] ,
            'email'  => $fields['email'],
            'password'  => bcrypt( $fields['password']),
        ]);

        $token = $user -> createToken('gdktoken')->plainTextToken;
        $response =[
            'user' => $user,
            'token'=>$token
        ];
        return response($response,201);

    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => "Deconnexion"
        ];
    }


    public function login(Request $request){
        $fields= $request -> validate([
            'email' => 'required |string',
            'password' => 'required | string',
        ]);

        // verification de l'email
        $user = User::where('email',$fields['email'])->first();

        // verification du mot de passe

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => "Identifiant ou mot de passe incorrect"
            ],401);
        }



        $token = $user -> createToken('gdktoken')->plainTextToken;
        $response =[
            'user' => $user,
            'token'=>$token
        ];
        return response($response,201);

    }
}
