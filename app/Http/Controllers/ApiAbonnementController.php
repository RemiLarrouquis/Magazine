<?php

namespace App\Http\Controllers;

use App\Abonnement;
use Carbon\Carbon;
use App\Fichier;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApiAbonnementController extends Controller
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

    public function getAll()
    {
        $abonnements = Abonnement::all();

        return Response::json(array(
            'error' => false,
            'abonnements' => $abonnements,
            'status_code' => 200
        ));
    }
}
