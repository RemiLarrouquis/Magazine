<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Hash;
use JWTAuth;
use App\Mail\ConfirmAdress;
use Illuminate\Support\Facades\Mail;

class APIController extends Controller
{

    public function register(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        // On confirme qu'il s'agit d'un client
        $input['is_client'] = true;
        $newUser = User::create($input);

        // Envoie d'un mail de confirmation
//        Mail::to($newUser->email)
//            ->send(new ConfirmAdress($newUser));

        return response()->json(['result'=>true]);
    }

    public function login(Request $request)
    {
        $input = $request->all();
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['result' => "Erreur d'identifiant ou mot de passe."]);
        }
        return response()->json(['result' => $token]);
    }

    public function confirm(Request $request)
    {
        $input = $request->all();
        $user = User::find($input['to_confirm']);
        $user->mail_confirm=true;
        $user->save();
        return response()->json(['result' => 'success', 'status' => 200]);
    }
}