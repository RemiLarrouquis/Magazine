<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Fichier;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

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
        $destinationPath = 'uploads';
        if (Input::file('photo') != null) {
            $dateNow = Carbon::now()->format('Ymd_His');
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = $dateNow . '.' . $extension; // renameing image
            Input::file('photo')->move($destinationPath, $fileName);

            $newfile = Fichier::Create([
                'nom_fichier' => $fileName,
                'nom_server' => $fileName,
            ]);
        } else {
            if ($request->id == NULL) {
                $newfile = DB::table('fichiers')->where('nom_fichier', 'empty.JPG')->first();
            } else {
                $newfile = new Fichier();
            }
        }
        if ($request->id == NULL) {

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
            if ($newfile->id != null) {
                DB::table('publications')->where('id', $request->id)->update(array('fichier_id' => $newfile->id));
            }
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

    public function liste() {

        $publications = DB::table('publications')->join('fichiers', 'fichiers.id', '=', 'publications.fichier_id')->paginate(6);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'publications' => $publications,
        );

        return view('publication.list', $data);
    }
}
