<?php

namespace App\Http\Controllers;

use Hash;
use JWTAuth;
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
        $abonnements = Abonnement::where('client_id', $user->id)->get();

        return response()->json([
            'error' => false,
            'abonnements' => $abonnements,
            'status_code' => 200
        ]);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);

        $abo = Abonnement::Create([
            'publication_id' => $input['publication_id'],
            'client_id' => $user->id,
            'etat_id' => $input['etat_id'],
            'paye_id' => $input['paye_id'],
            'date_fin' => $input['date_fin'],
            'date_pause' => $input['date_pause'],
        ]);

        return response()->json([
            'error' => false,
            'abonnements' => $abo,
            'status_code' => 200
        ]);
    }
}
