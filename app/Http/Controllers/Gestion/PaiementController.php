<?php

namespace App\Http\Controllers\Gestion;

use App\Services\PaiementServices;
use App\Services\StatusServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaiementController extends Controller
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

    }

    // Reçoit le callback de validation d'un paiement
    public function success(Request $request)
    {

    }

}
