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
        $publication = new Publication();
        $data = array(
            'publication' => $publication,
        );

        return view('publication.publicationform', $data);
    }

    public function savePublication(Request $request)
    {

        if ($request->id == NULL) {
            $destinationPath = 'uploads';
            $dateNow = Carbon::now()->format('Ymd_His');
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = $dateNow . '.' . $extension; // renameing image
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
        } else {
            $publication = Publication::Find($request->id);
            $publication->update($request->all());
        }


        return redirect('home');
    }

    public function editForm($id)
    {
        $publication = Publication::find($id);
        $fichier = Fichier::find($publication->fichier_id);
        $data = array(
            'publication' => $publication,
            'fichier' => $fichier
        );

        return view('publication.publicationform', $data);
    }

    public function editPublication(Request $request)
    {
        var_dump($request->id);
        exit();
    }
}
