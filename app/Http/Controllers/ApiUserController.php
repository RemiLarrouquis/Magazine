<?php

namespace App\Http\Controllers;

use Hash;
use JWTAuth;
use App\Abonnement;
use App\User;
use Carbon\Carbon;
use App\Fichier;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{

    public function details(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        return Response::json(array(
            'error' => false,
            'result' => $user,
            'status_code' => 200
        ));
    }

    // Vérifie si l'adresse mail est déjà utilisé
    public function userExist($email) {
        $user = User::where('email', $email)->get();

        if ($user == null) {
            return Response::json(array(
                'error' => false,
                'exist' => false,
                'status_code' => 200
            ));
        }
        return Response::json(array(
            'error' => false,
            'exist' => true,
            'status_code' => 200
        ));
    }


    public function update(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        if ($user->id == $input['id']) {
            $user->email = trim($input['email']);
            $user->nom = trim($input['nom']);
            $user->prenom = trim($input['prenom']);
            $user->save();
        }
        $token = JWTAuth::refresh($input['token']);
        return response()->json(['result' => $token]);
    }
}
