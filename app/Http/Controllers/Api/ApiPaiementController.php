<?php

namespace App\Http\Controllers\Api;

use App\Paiement;
use Hash;
use JWTAuth;
use App\Abonnement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Services\PaiementServices;
use App\Http\Controllers\Controller;

class ApiPaiementController extends Controller
{

    const PAYE = 7;
    const IMPAYE = 8;
    const REMBOURSE = 9;

    public function liste(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);

        $pub = null;
        if(array_key_exists('pub_id', $input)) {
            $pub = $input['pub_id'];
        }

        $paie = PaiementServices::liste($input, $user->id, $pub,false);

        return response()->json([
            'error' => false,
            'msg' => '',
            'abonnements' => $paie,
            'status_code' => 200
        ]);
    }

}
