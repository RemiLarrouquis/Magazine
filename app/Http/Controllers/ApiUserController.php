<?php

namespace App\Http\Controllers;

use App\Abonnement;
use App\User;
use Carbon\Carbon;
use App\Fichier;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
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

    public function user($id) {
        $user = '';
        // Vérifie qu'il s'agit d'un id en parametre
        if (is_numeric($id)) {
            $user = User::find($id);
        }

        return Response::json(array(
            'error' => false,
            'abonnements' => $user,
            'status_code' => 200
        ));
    }

    public function userExist($email) {
        $user = User::where('email', $email)->get();

        if ($user == null) {
            return Response::json(array(
                'error' => false,
                'exist' => false,
                'status_code' => 200
            ));
        }
        return Response::json(array(
            'error' => false,
            'exist' => true,
            'status_code' => 200
        ));
    }

    public function users() {
        $users = User::all();

        return Response::json(array(
            'error' => false,
            'abonnements' => $users,
            'status_code' => 200
        ));
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();
        if ($user->id == $request->request->get('id')) {
            $user->name = trim($request->request->get('name'));
            $user->email = trim($request->request->get('email'));
            $user->nom = trim($request->request->get('nom'));
            $user->prenom = trim($request->request->get('prenom'));
            if ($request->request->get('afficherReussi') == 'on') {
                $user->setting->afficherReussi = true;
            } else {
                $user->setting->afficherReussi = false;
            }
            $user->setting->save();
            $user->save();
        }
        return redirect(url('/user/get/'.$user->id));
    }
}
