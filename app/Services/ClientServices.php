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
        if (array_key_exists('filtreConfirm', $filters)) {
            $orderBy = 'mail_confirm';
            if ($filters['filtreConfirm'] == "true") {
                $orderAsc = 'asc';
            } else {
                $orderAsc = 'desc';
            }
        }
        // Filtres de nom
        if(array_key_exists('filterNom', $filters)) {
            $clients = DB::table('users')
                ->where('is_client', true)
                ->where('nom', 'like', '%'.$filters['filterNom'].'%')
                ->orWhere('nom', 'like', '%'.strtoupper($filters['filterNom']).'%')
                ->orWhere('nom', 'like', '%'.ucfirst($filters['filterNom']).'%')
                ->orderBy($orderBy, $orderAsc)
                ->paginate(12);

        } else {
            $clients = DB::table('users')
                ->where('is_client', true)
                ->orderBy($orderBy, $orderAsc)
                ->paginate(12);

        }

        return $clients;
    }
}
