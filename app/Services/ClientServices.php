<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\User;

class ClientServices {

    /**
     * Récupère la liste des clients en fonction de filtres
     * @param $filters
     * @return list de clients
     */
    public static function getClients($filters) {

        $query = User::query();
        $query->join('statuses', 'users.sexe_id', 'statuses.id');
        $query->select('users.*', 'statuses.id as idSexe', 'statuses.libelle_short as sexe');

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
            $query->where('is_client', true);
            $query->where('nom', 'like', '%' . $filters['filterNom'] . '%');
            $query->orWhere('nom', 'like', '%' . strtoupper($filters['filterNom']) . '%');
            $query->orWhere('nom', 'like', '%' . ucfirst($filters['filterNom']) . '%');
        }

        $query->orderBy($orderBy, $orderAsc);


        if(array_key_exists('noPaging', $filters)) {
            return $query->get();
        }
        return $query->paginate(12);
    }
}
