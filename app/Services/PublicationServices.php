<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class PublicationServices {

    /**
     * Récupère la liste des publications en fonction de filtres
     * @param $filters
     * @return list de publications
     */
    public static function getPublications($filters) {

        $publications = '';

        $orderBy = 'updated_at';
        $orderAsc = 'desc';
        if (array_key_exists('filterPrix', $filters)) {
            $orderBy = 'prix_an';
            if ($filters['filterPrix'] == "true") {
                $orderAsc = 'asc';
            } else {
                $orderAsc = 'desc';
            }
        }
        // Filtres de titre
        if(array_key_exists('filterTitre', $filters)) {
            $publications = DB::table('publications')
                ->where('titre', 'like', '%'.$filters['filterTitre'].'%')
                ->orWhere('titre', 'like', '%'.strtoupper($filters['filterTitre']).'%')
                ->orWhere('titre', 'like', '%'.ucfirst($filters['filterTitre']).'%')
                ->orderBy($orderBy, $orderAsc)
                ->paginate(6);

        } else {

            $publications = DB::table('publications')
                ->orderBy($orderBy, $orderAsc)
                ->paginate(6);

        }

        return $publications;
    }
}
