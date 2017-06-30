<?php

namespace App\Http\Controllers\Gestion;

use Illuminate\Http\Request;
use App\Services\HistoriqueServices;
use App\Http\Controllers\Controller;
use App\Services\StatusServices;


class HistoriqueController extends Controller
{

    const TYPE_HISTORIQUE = 4;
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

        $clients = HistoriqueServices::getHistoriques($req,null,12);
        $statuses = StatusServices::getStatusByType(self::TYPE_HISTORIQUE);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'clients' => $clients,
            'statuses' => $statuses,
        );

        if(!empty($req)) {
            return view('historique.list', $data)->render();
        }
        return view('historique.view', $data);

    }


    public function listeClient(Request $request,$id) {

        $req = $request->request->all();

        $clients = HistoriqueServices::getHistoriques($req,$id,12);
        $statuses = StatusServices::getStatusByType(self::TYPE_HISTORIQUE);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'clients' => $clients,
            'statuses' => $statuses,
        );

        if(!empty($req)) {
            return view('historique.list', $data)->render();
        }
        return view('historique.view', $data);

    }
}
