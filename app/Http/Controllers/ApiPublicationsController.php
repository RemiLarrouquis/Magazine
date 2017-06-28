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
        $input = $request->all();
        $pubs = \App\Publication::All();

        if (array_key_exists('token', $input)) {
            $user = JWTAuth::toUser($input['token']);
            foreach ($pubs as $pub) {
                $abo = AbonnementServices::getAbonnement($pub->id, $user->id);
                if ($abo) {
                    $pub->est_abonnee = true;
                } else {
                    $pub->est_abonnee = false;
                }
            }
        }
        return response()->json(array(
            'error' => false,
            'msg' => '',
            'result' => $pubs,
            'status_code' => 200
        ));
    }

    public function detail(Request $request)
    {
        $input = $request->all();
        $pubs = Publication::where('id', $input['id'])->get();

        if (array_key_exists('token', $input)) {
            $user = JWTAuth::toUser($input['token']);
            foreach ($pubs as $pub) {
                $abo = AbonnementServices::getAbonnement($input['id'], $user->id);
                if ($abo) {
                    $pub->est_abonnee = true;
                    if ($abo->etat_id == 4) {
                        $pub->pause_abo = false;
                    } else {
                        $pub->pause_abo = true;
                    }
                } else {
                    $pub->est_abonnee = false;
                }
            }
        }
        return response()->json(array(
            'error' => false,
            'msg' => '',
            'result' => $pubs,
            'status_code' => 200
        ));
    }

}
