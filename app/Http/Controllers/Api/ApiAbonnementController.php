<?php

namespace App\Http\Controllers\Api;

use Hash;
use JWTAuth;
use App\Abonnement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Services\AbonnementServices;
use App\Http\Controllers\Controller;

class ApiAbonnementController extends Controller
{

    const EN_COURS = 4;
    const STOP = 5;
    const TERMINE = 6;

    const PAYE = 7;
    const IMPAYE = 8;
    const REMBOURSE = 9;

    public function liste(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);

        // $abos = AbonnementServices::listAbonnements($input, $user->id, false);
        $abos = AbonnementServices::listAboWithPaiement($input, $user->id);

        return response()->json([
            'error' => false,
            'msg' => '',
            'abonnements' => $abos,
            'status_code' => 200
        ]);
    }

    public function detail(Request $request)
    {
        $input = $request->all();
        $ab = Abonnement::where('abonnements.id', $input['id'])
            ->join('publications', 'publications.id', 'publication_id')
            ->select('abonnements.*', 'publications.titre', 'publications.description', 'publications.image', 'publications.nb_an', 'publications.prix_an')
            ->get();

        return response()->json(array(
            'error' => false,
            'msg' => '',
            'result' => $ab,
            'status_code' => 200
        ));
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        $idPub = array_key_exists('id', $input) ? $input['id'] : null;
        if (!$idPub) {
            return response()->json(['error' => true, 'msg' => "Veuillez renseigner l'id de la publication", 'status_code' => 200,
                'result' => "",
            ]);
        }

        $msg = AbonnementServices::newAbonnement($idPub, $user->id);

        return response()->json(['error' => false, 'msg' => $msg, 'result' => '', 'status_code' => 200]);
    }

    public function relance(Request $request)
    {
        $input = $request->all();
        $idAbo = array_key_exists('id', $input) ? $input['id'] : null;

        if (!$idAbo) {
            return response()->json(['error' => true, 'status_code' => 200,
                'msg' => "Veuillez renseigner l'id de l'abonnement", 'result' => '',
            ]);
        }
        AbonnementServices::relance($idAbo);

        return response()->json(['error' => false, 'msg' => "Relance de l'abonnement effectué.", 'result' => 'Success', 'status_code' => 200]);
    }
}
