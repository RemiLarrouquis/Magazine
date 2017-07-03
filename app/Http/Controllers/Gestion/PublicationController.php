<?php

namespace App\Http\Controllers\Gestion;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Services\PublicationServices;
use App\Http\Controllers\Controller;

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
            'sub_title' => "Création d'une nouvelle publication.",
        );

        return view('publication.form', $data);
    }

    public function editForm($id)
    {
        $publication = Publication::find($id);
        $data = array(
            'publication' => $publication,
            'sub_title' => "Edition d'une publication.",
        );

        return view('publication.form', $data);
    }

    public function liste(Request $request) {

        $req = $request->request->all();
        // unset($req['page']); //On retire la pagination du tableau
        $publications = PublicationServices::getPublications($req);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'publications' => $publications,
        );

        // if(array_key_exists('filterTitre', $req) || array_key_exists('filterPrix', $req)) {
        if(array_key_exists('full', $req) && $req['full'] == "false") {
            return view('publication.list', $data)->render();
        }
        return view('publication.view', $data);
    }

    public function savePublication(Request $request)
    {
        $destinationPath = 'uploads';
        $fileName = '';
        $dataUri = '';
        if (Input::file('photo') != null) {
            // $dateNow = Carbon::now()->format('Ymd_His');
            // $extension = Input::file('photo')->getClientOriginalExtension();
            // $fileName = $dateNow . '.' . $extension; // renameing image
            // Input::file('photo')->move($destinationPath, $fileName);

            $image = Input::file('photo');
            $type = pathinfo($image, PATHINFO_EXTENSION);
            $data = file_get_contents($image);
            $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);

        } else {
            if ($request->id == NULL) {
                $image = 'uploads\empty.JPG';
                $type = pathinfo($image, PATHINFO_EXTENSION);
                $data = file_get_contents($image);
                $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        }

        if ($request->id == NULL) {

            Publication::Create([
                'image' => $dataUri,
                'titre' => trim($request->titre),
                'nb_an' => $request->nb_an,
                'prix_an' => $request->prix_an,
                'description' => trim($request->description)
            ]);
        } else {

            $publication = Publication::find($request->id);

            if ($dataUri == '') {
                $dataUri = $publication->image;
            }

            $toUpdate = $request->request->all();
            $toUpdate['image'] = $dataUri;

            $publication->update($toUpdate);
        }

        return redirect('home');
    }
}
