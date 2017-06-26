<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Services\ClientServices;

class ClientController extends Controller
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
        $clients = ClientServices::getClients($req);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'clients' => $clients,
        );

        if(!empty($req)) {
            return view('client.list', $data)->render();
        }
        return view('client.view', $data);
    }

    public function detail(Request $request) {
        return view('client.detail');
    }
}
