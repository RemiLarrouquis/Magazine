<?php

namespace App\Http\Controllers\Gestion;

use App\Historique;
use App\Services\ClientServices;
use Illuminate\Http\Request;
use App\Services\HistoriqueServices;
use App\Http\Controllers\Controller;
use App\Services\StatusServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'type_id'      => 'required|numeric',
            'description'  => 'required',
        ]);
    }

    public function newHistorique(Request $request)
    {
        $req = $request->request->all();
        // Ajoute un element qui permet de retourner tous les résultats
        $req['noPaging'] = true;

        $historique = new Historique();

        $data = $this->getDataForForm($req, $historique, "Création d'une nouvelle relation client.");

        if(array_key_exists('client_id', $req)) {
            $data['selectedClient'] = \App\User::where('id', $req['client_id'])->first();
        }

        return view('historique.form', $data);
    }

    public function liste(Request $request) {

        $req = $request->request->all();

        if (!array_key_exists('count', $req)) {
            $req['count'] = 12;
        }
        if (!array_key_exists('client_id', $req)) {
            $req['client_id'] = null;
        }

        $histos = HistoriqueServices::getHistoriques($req, $req['client_id'], $req['count']);
        $types = StatusServices::getStatusByType(self::TYPE_HISTORIQUE);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'histos' => $histos,
            'types' => $types,
        );

        if(array_key_exists('full', $req) && $req['full'] == "false") {
            return view('historique.list', $data)->render();
        }
        return view('historique.view', $data);

    }

    public function saveHistorique(Request $request)
    {
        $user = Auth::user();

        // Données communes
        $toCreate = [];
        $toCreate['type_id'] = $request['type_id'];
        $toCreate['description'] = $request['description'];
        $toCreate['employe_id'] = $user->id;

        $clients = [100];
        if ($request['tous'] != 'on') {
            $clients = explode(',', $request['clients']);
        }

        $valid = $this->validator($toCreate);
        if ($valid->fails()) {
            // Ajoute un element qui permet de retourner tous les résultats
            $req['noPaging'] = true;

            $data = $this->getDataForForm($req, $toCreate, "Création d'une nouvelle relation client.");
            return view('historique.form', $data);
        } else {
            if (count($clients) > 1) {
                foreach($clients as $idClient) {
                    $toCreate['client_id'] = $idClient;
                    HistoriqueServices::newHistorique($toCreate);
                }
            } else {
                $toCreate['client_id'] = $clients[0];
                HistoriqueServices::newHistorique($toCreate);
            }
        }

        return redirect('/historique/list');
    }

    private function getDataForForm($req, $histo, $title) {

        $clients = ClientServices::getClients($req);
        $statuses = StatusServices::getStatusByType(self::TYPE_HISTORIQUE);

        $data = array(
            'historique' => $histo,
            'clients' => $clients,
            'statuses' => $statuses,
            'sub_title' => $title,
        );
        return $data;
    }
}
