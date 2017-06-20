<?php

namespace App\Http\Controllers;

use App\Abonnement;
use Carbon\Carbon;
use App\Fichier;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApiAbonnementController extends Controller
{
    public function liste(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);

        $abonnements = Abonnement::where('client_id', $user->id);

        return Response::json(array(
            'error' => false,
            'abonnements' => $abonnements,
            'status_code' => 200
        ));
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);

        $abonnements = Abonnement::where('client_id', $user->id);

        return Response::json(array(
            'error' => false,
            'abonnements' => $abonnements,
            'status_code' => 200
        ));
    }
}
