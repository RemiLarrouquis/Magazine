<?php

namespace App\Http\Controllers\Gestion;

use App\Historique;
use App\Services\ClientServices;
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

    public function newHistorique(Request $request)
    {
        $historique = new Historique();
        $req = $request->request->all();
        $clients = ClientServices::getClients($req);
        $statuses = StatusServices::getStatusByType(self::TYPE_HISTORIQUE);

        $data = array(
            'historique' => $historique,
            'clients' => $clients,
            'statuses' => $statuses,
            'sub_title' => "Création d'une nouvelle relation client.",
        );

        return view('historique.form', $data);
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

        if(array_key_exists('full', $req) && $req['full'] == "false") {
            return view('historique.list', $data)->render();
        }
        return view('historique.view', $data);

    }


    public function listeClient(Request $request) {

        $req = $request->request->all();

        $clients = HistoriqueServices::getHistoriques($req, $req['client_id'],$req['count']);
        $statuses = StatusServices::getStatusByType(self::TYPE_HISTORIQUE);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'clients' => $clients,
            'statuses' => $statuses,
        );

        if(array_key_exists('full', $req) && $req['full'] == "false") {
            return view('historique.list', $data)->render();
        }
        return view('historique.view', $data);

    }

    public function saveHistorique(Request $request)
    {

        if ($request->id == NULL) {

            Publication::Create([
                'client_id' => $request->client_id,
                'status_id' => $request->type_id,
                'employe_id' => Auth::user()->id,
                'description' => trim($request->description)
            ]);
        } else {

            $historique = Historique::find($request->id);

            $toUpdate = $request->request->all();

            $historique->update($toUpdate);
        }

        return redirect('home');
    }
}
