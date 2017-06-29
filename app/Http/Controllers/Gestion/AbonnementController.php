<?php

namespace App\Http\Controllers\Gestion;

use App\Services\AbonnementServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Services\PublicationServices;
use App\Http\Controllers\Controller;

class AbonnementController extends Controller
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

    public function liste(Request $request)
    {
        $req = $request->request->all();

        // unset($req['page']); //On retire la pagination du tableau
        $abos = AbonnementServices::listAbonnements($req, null, true);
        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'abos' => $abos,
        );

        if (!empty($req)) {
            return view('abonnement.list', $data)->render();
        }
        return view('abonnement.view', $data);
    }
}
