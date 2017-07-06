<?php

namespace App\Http\Controllers\Gestion;

use App\Services\PaiementServices;
use App\Services\StatusServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaiementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste(Request $request) {

        $req = $request->request->all();
        // unset($req['page']); //On retire la pagination du tableau
        $paies = PaiementServices::liste($req, null, null, $req['abo_id'], false);

        $i = 0;
        foreach ($paies as $paie) {
            $i++;
            $paie->numero = $i;
            $t = strtotime($paie->date_fin);
            $t2 = strtotime('-1 year', $t);
            $paie->date_debut = date('Y-m-d', $t2);
        }

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'paies' => $paies,
        );

        // if(array_key_exists('filterTitre', $req) || array_key_exists('filterPrix', $req)) {
        if(array_key_exists('full', $req) && $req['full'] == "false") {
            return view('paiement.list', $data)->render();
        }
        return view('paiement.modal', $data);
    }

    // Reçoit le callback de validation d'un paiement
    public function success(Request $request)
    {

    }

}
