<?php

namespace App\Http\Controllers\Gestion;

use App\Services\AbonnementServices;
use App\Services\StatusServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbonnementController extends Controller
{
    const TYPE_SEXE = 1;
    const TYPE_ABO_ENCOURS = 2;
    const TYPE_ABO_PAYE = 3;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste(Request $request)
    {
        $req = $request->request->all();

        if (!array_key_exists('count', $req)) {
            $req['count'] = 12;
        }
        if (!array_key_exists('client_id', $req)) {
            $req['client_id'] = null;
        }

        $abos = AbonnementServices::listAbonnements($req, $req['client_id'], $req['count']);
        $statuses = StatusServices::getStatusByType(self::TYPE_ABO_PAYE);
        $etats = StatusServices::getStatusByType(self::TYPE_ABO_ENCOURS);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'abos' => $abos,
            'statuses' => $statuses,
            'etats' => $etats,
        );

        if (array_key_exists('full', $req) && $req['full'] == "false") {
            return view('abonnement.list', $data)->render();
        }
        return view('abonnement.view', $data);
    }

    /**
     * Pour AJAX request
     * @param $id
     * @return Objet Json
     */
    public function pause($id) {
        AbonnementServices::pause($id);
        return redirect('/abonnement/list');
    }
    /**
     * Pour AJAX request
     * @param $id
     * @return Objet Json
     */
    public function reprise($id) {
        AbonnementServices::repriseApresPause($id);
        return redirect('/abonnement/list');
    }
}
