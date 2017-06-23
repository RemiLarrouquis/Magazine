<?php

namespace App\Http\Controllers;

use Hash;
use JWTAuth;
use App\Abonnement;
use App\Publication;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Services\AbonnementServices;

class ApiPublicationsController extends Controller
{

    public function liste(Request $request)
    {
        $pubs = \App\Publication::All();
        return response()->json(array(
            'error' => false,
            'result' => $pubs,
            'status_code' => 200
        ));
    }

    public function detail(Request $request)
    {
        $input = $request->all();
        $pubs = Publication::where('id', $input['id'])->get();

        $est_abonnee = false;
        if (array_key_exists('token', $input)) {
            $user = JWTAuth::toUser($input['token']);
            $abo = AbonnementServices::getAbonnement($input['id'], $user->id);
            if ($abo) {
                $est_abonnee = true;
            }
        }
        return response()->json(array(
            'error' => false,
            'result' => $pubs,
            'user_est_abonnee' => $est_abonnee,
            'status_code' => 200
        ));
    }

}
