<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;

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
}
