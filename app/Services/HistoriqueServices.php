<?php

namespace App\Services;

use App\Historique;
use Carbon\Carbon;
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
            $query->whereIn('client_id', array($IdUser, 100));
        }
        $query->join('users', 'users.id', 'client_id');
        $query->join('users as employe', 'employe.id', 'employe_id');
        $query->join('statuses as type', 'type.id', 'type_id');
        $query->select('historiques.*', 'employe.nom as employe_nom', 'users.nom as client_nom', 'users.prenom as client_prenom', 'type.libelle as type_libelle');

        // Filtres de types
        if (array_key_exists('filterType', $filters)) {
            $query->where('type_id', $filters['filterType']);
        }

        // Filtres de nom
        if(array_key_exists('filterNom', $filters)) {
            $query->where(function($q) use ($filters) {
                $q->where('employe.nom', 'like', '%'.$filters['filterNom'].'%');
                $q->orWhere('employe.nom', 'like', '%'.strtoupper($filters['filterNom']).'%');
                $q->orWhere('employe.nom', 'like', '%'.ucfirst($filters['filterNom']).'%');
            });
        }

        $query->orderBy($orderBy, $orderAsc);
        if ($paging) {
            return $query->paginate($paging);
        } else {
            return $query->get();
        }

    }

    public static function newHistorique($values) {
        Historique::Create([
            'type_id' => $values['type_id'],
            'description' => $values['description'],
            'employe_id' => $values['employe_id'],
            'client_id' => $values['client_id'],
            'date' => Carbon::now()
        ]);
    }
}
