<?php

namespace App\Http\Controllers\Gestion;

use App\Services\AbonnementServices;
use App\Services\StatusServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbonnementController extends Controller
{
    const IDENTIFIANT = 'a7111252-62b2-9ff7-5487-9d7c0c6b9b21';
    const IP = '10.0.0.6';
    const TCP = '6543';
    const PROTOCOLE = 'HTTP';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Reçoit le callback de validation d'un paiement
    public function success(Request $request)
    {

    }

}
