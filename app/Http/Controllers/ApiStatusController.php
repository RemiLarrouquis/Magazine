<?php

namespace App\Http\Controllers;

use Hash;
use JWTAuth;
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
use App\Services\StatusServices;

class ApiStatusController extends Controller
{

    const TYPE_SEXE = 1;
    const TYPE_ABO_ENCOURS = 2;
    const TYPE_ABO_PAYE = 3;

    public function listeSexe(Request $request)
    {
        $res = StatusServices::getStatusByType(self::TYPE_SEXE);

        return Response::json(array(
            'error' => false,
            'result' => $res,
            'status_code' => 200
        ));
    }

    public function listeAboEnCours(Request $request)
    {
        $res = StatusServices::getStatusByType(self::TYPE_ABO_ENCOURS);

        return Response::json(array(
            'error' => false,
            'result' => $res,
            'status_code' => 200
        ));
    }

    public function listeAboPaye(Request $request)
    {
        $res = StatusServices::getStatusByType(self::TYPE_ABO_PAYE);

        return Response::json(array(
            'error' => false,
            'result' => $res,
            'status_code' => 200
        ));
    }

}
