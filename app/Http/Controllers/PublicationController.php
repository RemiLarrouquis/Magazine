<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Fichier;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function newPublication()
    {
        $publications = Publication::All();

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'publications' => $publications,
        );

        return view('publication.publicationform', $data);
    }

    public function savePublication(Request $request)
    {
        $destinationPath = 'uploads';
        $dateNow = Carbon::now()->format('Ymd_His');
        $extension = Input::file('photo')->getClientOriginalExtension();
        $fileName = $dateNow.'.'.$extension; // renameing image
        Input::file('photo')->move($destinationPath, $fileName);

        $newfile = Fichier::Create([
            'nom_fichier' => $fileName,
            'nom_server' => $fileName,
        ]);

        Publication::Create([
            'fichier_id' => $newfile->id,
            'titre' => trim($request->titre),
            'nb_an' => $request->nban,
            'prix_an' => $request->prixan,
            'description' => trim($request->description)
        ]);


        $publications = Publication::All();

        $data = array(
            'publications' => $publications,
        );

        return view('home', $data);

    }
}
