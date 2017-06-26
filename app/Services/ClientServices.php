<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ClientServices {

    /**
     * Récupère la liste des clients en fonction de filtres
     * @param $filters
     * @return list de clients
     */
    public static function getClients($filters) {

        $clients = '';

        $orderBy = 'created_at';
        $orderAsc = 'desc';
        // if (array_key_exists('filterPrix', $filters)) {
        //    $orderBy = 'prix_an';
        //    if ($filters['filterPrix'] == "true") {
        //        $orderAsc = 'asc';
        //    } else {
        //        $orderAsc = 'desc';
        //    }
        //}
        // Filtres de titre
        if(array_key_exists('filterNom', $filters)) {
            $clients = DB::table('users')
                ->where('is_client', true)
                ->where('nom', 'like', '%'.$filters['filterTitre'].'%')
                ->orWhere('nom', 'like', '%'.strtoupper($filters['filterTitre']).'%')
                ->orWhere('nom', 'like', '%'.ucfirst($filters['filterTitre']).'%')
                ->orderBy($orderBy, $orderAsc)
                ->paginate(6);

        } else {

            $clients = DB::table('users')
                ->where('is_client', true)
                ->orderBy($orderBy, $orderAsc)
                ->paginate(6);

        }

        return $clients;
    }
}
