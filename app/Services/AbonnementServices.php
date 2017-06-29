<?php

namespace App\Services;

use App\Abonnement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AbonnementServices
{

    const EN_COURS = 4;
    const PAUSE = 5;
    const ARRETER = 6;

    const PAYE = 7;
    const IMPAYE = 8;
    const REMBOURSE = 9;

    /**
     * Action "s'abonner" à une publication
     * 1 - Créé un nouvel abonnement
     * 2 - Change le status de l'abonnement (En cours <-> Stoppé)
     *
     * @param $filters
     * @return Un tableau contenant un message d'erreur avec code
     */
    public static function newAbonnement($idPub, $idUser)
    {
        $msg = '';
        $abo = self::getAbonnement($idPub, $idUser);

        if ($abo) {
            if ($abo->etat_id == self::EN_COURS) {
                $abo->etat_id = self::ARRETER;
                $msg = "Abonnement arreté";
            } else {
                $abo->etat_id = self::EN_COURS;
                $msg = "Abonnement en cours";
            }
            $abo->save();
        } else {
            $msg = "Abonnement créé";
            Abonnement::Create([
                'publication_id' => $idPub,
                'client_id' => $idUser,
                'etat_id' => self::EN_COURS,
                'paye_id' => self::PAYE,
                'date_fin' => Carbon::now()->addYear(),
            ]);
        }
        return $msg;
    }

    public static function relance($idAbo)
    {
        $abo = Abonnement::find($idAbo);
        $abo->date_fin = Carbon::parse($abo->date_fin)->addYear();
        $abo->paye_id = self::IMPAYE;
        $abo->etat_id = self::EN_COURS;
        $abo->save();
    }

    /**
     * Récupère un abonnement en fonction d'un utilisateur et une publication
     * @param $idPub
     * @param $idUser
     * @return mixed
     */
    public static function getAbonnement($idPub, $idUser)
    {
        return Abonnement::where('publication_id', $idPub)->where('client_id', $idUser)->first();
    }

    /**
     * Récupère la liste des abonnements en fonction de filtres
     * @param $filters
     * @param $isUser
     * @return list d'abonnements
     */
    public static function listAbonnements($filters, $IdUser, $paging)
    {

        $query = Abonnement::query();
        if ($IdUser) {
            $query->where('client_id', $IdUser);
        }
        $query->join('publications', 'publications.id', 'publication_id');
        $query->join('users', 'users.id', 'client_id');
        $query->join('statuses as etat', 'etat.id', 'etat_id');
        $query->join('statuses as paye', 'paye.id', 'paye_id');
        $query->join('statuses as sexe', 'sexe.id', 'sexe_id');
        $query->select('abonnements.*', 'publications.titre', 'publications.description', 'publications.image',
            'publications.nb_an', 'publications.prix_an', 'users.nom', 'users.prenom',
            'sexe.libelle_short as sexe_libelle', 'paye.libelle as paye_libelle', 'etat.libelle as etat_libelle');

        // Etat (encours, stop, pause
        if (array_key_exists('filterEtat', $filters)) {
            $query->where('etat_id', $filters['filterEtat']);
        }
        // Status (payé, ompayé, remboursé
        if (array_key_exists('filterPaye', $filters)) {
            $query->where('paye_id', $filters['filterPaye']);
        }
        // En cours  -  Ancients
        if (array_key_exists('filterEnCours', $filters)) {
            if ($filters['filterEnCours'] == "true") {
                $query->whereDate('date_fin', ">", Carbon::today()->toDateString());
            } else {
                $query->whereDate('date_fin', "<", Carbon::today()->toDateString());
            }

        }

        $orderBy = 'abonnements.date_fin';
        $orderAsc = 'asc';

        $query->orderBy($orderBy, $orderAsc);

        if ($paging) {
            return $query->paginate(10);
        } else {
            return $query->get();
        }
    }
}