<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
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

    public function detail($id) {
        $query = User::query();
        $query->where('users.id', $id);
        $query->join('statuses', 'users.sexe_id', 'statuses.id');
        $query->select('users.*', 'statuses.id as idSexe', 'statuses.libelle');
        $client = $query->first();
        if ($client->is_client) {
            return view('client.detail', array('client' => $client));
        }
        return view('errors.404');
    }
}
