<?php

namespace App\Http\Controllers\Gestion;

use App\User;
use Illuminate\Http\Request;
use App\Services\ClientServices;
use App\Http\Controllers\Controller;
use App\Services\StatusServices;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    const TYPE_SEXE = 1;

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
            'nom'           => 'required|string|max:255',
            'prenom'        => 'required|string|max:255',
            'sexe_id'       => 'required|numeric',
            'date_naissance'=> 'required|date',
            'lieu_naissance'=> 'required|string|max:255',
            'adresse'       => 'required|string|max:255',
            'code_postal'   => 'required|numeric',
            'telephone'     => 'required',
        ]);
    }

    public function liste(Request $request) {

        $req = $request->request->all();
        $clients = ClientServices::getClients($req);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'clients' => $clients,
        );

        if(array_key_exists('full', $req) && $req['full'] == "false") {
            return view('client.list', $data)->render();
        }
        return view('client.view', $data);
    }

    public function detail($id) {

        if (!is_numeric($id)) {
            return view('errors.500');
        }
        $query = User::query();
        $query->where('users.id', $id);
        $query->join('statuses', 'users.sexe_id', 'statuses.id');
        $query->select('users.*', 'statuses.id as idSexe', 'statuses.libelle');
        $client = $query->first();

        // Récupérarion de la civilité
        $statuses = StatusServices::getStatusByType(self::TYPE_SEXE);

        if ($client->is_client) {
            return view('client.detail', array('client' => $client, 'statuses' => $statuses));
        }
        return view('errors.404');
    }

    public function edit(Request $request) {

        $input = $request->all();
        // Valide le formulaire
        $valid = $this->validator($input);

        if ($valid->fails()) {
            return response()->json(['errors' => true, 'msg' => $valid->errors(), 'result'=> '']);
        } else {
            $user = User::find($input['id']);

            // Supprime les champs qui ne peuvent être assigné
            unset($input['_token']);
            unset($input['id']);

            $user->update($input);

            return response()->json(['errors' => false, 'msg' => "Modification de l'utilisateur.",'result' => ""]);

        }
    }
}
