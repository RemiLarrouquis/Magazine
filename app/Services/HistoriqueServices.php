<?php

namespace App\Services;

use App\Historique;
use Illuminate\Support\Facades\DB;

class HistoriqueServices {

    /**
     * Récupère la liste des clients en fonction de filtres
     * @param $filters
     * @return list de clients
     */
    public static function getHistoriques($filters, $IdUser, $paging) {

        $orderBy = 'date';
        $orderAsc = 'desc';

        $query = Historique::query();
        if ($IdUser) {
            $query->where('client_id', $IdUser);
        }
        $query->join('users', 'users.id', 'client_id');
        $query->join('users as employe', 'employe.id', 'employe_id');
        $query->join('statuses as type', 'type.id', 'status_id');
        $query->select('historiques.*', 'employe.nom as employe_nom', 'employe.prenom as employe_prenom', 'users.nom as client_nom', 'users.prenom as client_prenom', 'type.libelle as type_libelle');



        // Filtres de nom
        if(array_key_exists('filterNom', $filters)) {
            $query->orderBy($orderBy, $orderAsc)
                ->paginate(12);

        } else {
            $query->orderBy($orderBy, $orderAsc)
                ->paginate(12);

        }

        if ($paging) {
            return $query->paginate($paging);
        } else {
            return $query->get();
        }

    }
}
