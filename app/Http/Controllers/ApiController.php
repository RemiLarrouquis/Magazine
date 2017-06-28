<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Hash;
use JWTAuth;
use App\Mail\ConfirmAdress;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6',
            'nom'           => 'required|string|max:255',
            'prenom'        => 'required|string|max:255',
            'sexe_id'       => 'required|numeric',
            'date_naissance'=> 'required|date',
            'lieu_naissance'=> 'required|string|max:255',
            'adresse'       => 'required|string|max:255',
            'code_postal'   => 'required|numeric',
            'telephone'     => 'required|numeric',
        ]);
    }

    public function register(Request $request)
    {
        $input = $request->all();
        // Valide le formulaire
        $valid = $this->validator($input);

        if ($valid->fails()) {
            return response()->json(['errors' => true, 'result'=>$valid->errors()]);
        } else {
            // Hash le mot de passe avant sauvegarde
            $input['password'] = Hash::make($input['password']);
            // On indique qu'il s'agit d'un client
            $input['is_client'] = true;
            $newUser = User::create($input);

            // Envoie d'un mail de confirmation
            Mail::to($newUser->email)
              ->send(new ConfirmAdress($newUser));

            return response()->json(['errors' => false, 'result' => "Utilisateur créé."]);

        }

    }

    public function login(Request $request)
    {
        $input = $request->all();
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['error' => true, 'result' => "Erreur d'identifiant ou mot de passe."]);
        }
        $user = JWTAuth::toUser($token);
        if ($user->mail_confirm == true) {
            return response()->json(['error' => false, 'result' => $token]);
        } else {
            return response()->json(['error' => true, 'result' => "Veuillez confirmer votre inscription par mail."]);
        }
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