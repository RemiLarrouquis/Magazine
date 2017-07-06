<?php

namespace App\Http\Controllers\Api;

use App\Paiement;
use Hash;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use Illuminate\Http\Request;
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
        $url = PaiementServices::prepareUrlPaye($paie, $input['cardnumber'], $input['cardmonth'], $input['cardyear']);
        // Indique l'envoie d'un paiement
        $paie = PaiementServices::sendPaiement($paie->cid);

        // Send CURL api request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        $content = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $msg = "";
        $error = true;
        if ($content == 400) {
            $msg = "Un des paramètres de la requête est incorrect.";
        } else if ($content == 403) {
            $msg = "l'adresse IP du serveur qui appelle le service n'est pas correcte.";
        } else if ($content == 500) {
            $msg = "Erreur de connexion au web service.";
        } else {
            $error = false;
            $msg = "Authorisation en cours. Veuillez rafraichir la page pour voir l'avancé du paiment.";
        }
        if ($error) {
            PaiementServices::errorPaiement($paie->cid);
        }
        return response()->json([
            'error' => $error,
            'msg' => $msg,
            'result' => '', 'status_code' => $content
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

    public function success(Request $request)
    {
        $transac = request('transaction');
        $cid = request('cid');

        PaiementServices::validePaiement($cid, $transac);

        return response()->json('ok', 200);
    }

    public function rembourser(Request $request) {

        $cid = null;
        $amount = null;

        if (request()->has('amount')) {
            $amount = request('amount');
        }
        if (request()->has('tout') && request('amount') == 'true') {
            $amount = null;
        }
        if (request()->has('cid')) {
            $cid = request('cid');
        }

        if ($cid != null) {
            PaiementServices::remboursementPaiement($cid, $amount);
        } else {
            return response()->json('Erreur données manquantes', 404);
        }
        return response()->json('ok', 200);

    }
}
