<?php

namespace App\Http\Controllers\Api;

use App\Paiement;
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
use App\Services\PaiementServices;
use App\Http\Controllers\Controller;

class ApiPaiementController extends Controller
{

    const PAYE = 7;
    const IMPAYE = 8;
    const REMBOURSE = 9;

    public function liste(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);

        $pub = null;
        if(array_key_exists('pub_id', $input)) {
            $pub = $input['pub_id'];
        }

        $paie = PaiementServices::liste($input, $user->id, $pub, null, false);

        return response()->json([
            'error' => false,
            'msg' => '',
            'result' => $paie,
            'status_code' => 200
        ]);
    }

    public function paiement(Request $request) {
        $input = $request->all();
        if (!array_key_exists('paie_id', $input)) {
            return response()->json([
                'error' => true, 'msg' => "Veuillez renseigner l'id du paiement",
                'result' => '', 'status_code' => 200
            ]);
        }
        $paie = Paiement::find($input['paie_id']);
        PaiementServices::sendPaiement($paie->cid);

        // On lance ici la requete vers le ws easypay

        // Puis on s'en va
        return response()->json([
            'error' => false,
            'msg' => "Authorisation en cours. Veuillez rafraichir la page pour voir l'avancé du paiment.",
            'result' => '', 'status_code' => 200
        ]);
    }

    public function detail(Request $request)
    {
        $input = $request->all();
        $ab = Paiement::where('paiements.id', $input['id'])
            ->select('paiements.*')
            ->get();

        return response()->json(array(
            'error' => false,
            'msg' => '',
            'result' => $ab,
            'status_code' => 200
        ));
    }

}
