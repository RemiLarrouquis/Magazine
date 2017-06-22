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

class ApiPublicationsController extends Controller
{

    public function liste(Request $request)
    {
        $pubs = \App\Publication::All();
        return response()->json(array(
            'error' => false,
            'result' => $pubs,
            'status_code' => 200
        ));
    }

    public function detail(Request $request)
    {
        $input = $request->all();
        $pubs = Publication::where('id', $input['id'])->get();
        return response()->json(array(
            'error' => false,
            'result' => $pubs,
            'status_code' => 200
        ));
    }

}
