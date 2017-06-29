<?php

namespace App\Http\Controllers\Api;

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
use App\Http\Controllers\Controller;

class ApiUserController extends Controller
{

    public function details(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        return Response::json(array(
            'error' => false,
            'msg' => '',
            'result' => $user,
            'status_code' => 200
        ));
    }

    // Vérifie si l'adresse mail est déjà utilisé
    public function userExist(Request $request) {
        $input = $request->all();
        $user = User::where('email', $input['email'])->get();

        if ($user->isEmpty()) {
            return Response::json(array(
                'error' => false,
                'msg' => '',
                'exist' => false,
                'status_code' => 200
            ));
        }
        return Response::json(array(
            'error' => false,
            'msg' => 'Cette adresse mail est déjà utilisé',
            'exist' => true,
            'status_code' => 200
        ));
    }


    public function update(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        if ($user->id == $input['id']) {
            $user->update($input);
        }
        $token = JWTAuth::refresh($input['token']);
        return response()->json(['error' => false,
            'msg' => 'Utilisateur mis à jour avec success',
            'result' => $token
        ]);
    }
}
