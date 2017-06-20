<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $fileName = '';
        if (Input::file('photo') != null) {
            $dateNow = Carbon::now()->format('Ymd_His');
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = $dateNow . '.' . $extension; // renameing image
            Input::file('photo')->move($destinationPath, $fileName);

        } else {
            if ($request->id == NULL) {
                $fileName = 'empty.JPG';
            }
        }

        if ($request->id == NULL) {

            Publication::Create([
                'image' => $fileName,
                'titre' => trim($request->titre),
                'nb_an' => $request->nb_an,
                'prix_an' => $request->prix_an,
                'description' => trim($request->description)
            ]);
        } else {

            $publication = Publication::find($request->id);

            if ($fileName == '') {
                $fileName = $publication->image;
            }

            $toUpdate = $request->request->all();
            $toUpdate['image'] = $fileName;

            $publication->update($toUpdate);
        }

        return redirect('home');
    }

    public function editForm($id)
    {
        $publication = Publication::find($id);
        $data = array(
            'publication' => $publication,
        );

        return view('publication.publicationform', $data);
    }

    public function liste() {

        $publications = DB::table('publications')
            ->orderBy('updated_at', 'desc')
            ->paginate(6);

        // Attention toujours inclure dans un tableau les résultats
        $data = array(
            'publications' => $publications,
        );

        return view('publication.list', $data);
    }
}
