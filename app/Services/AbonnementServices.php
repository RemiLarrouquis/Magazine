<?php
namespace App\Services;

use App\Abonnement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AbonnementServices {

    const EN_COURS = 4;
    const STOP = 5;
    const TERMINE = 6;

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
    public static function newAbonnement($idPub, $idUser) {

        $abo = self::getAbonnement($idPub, $idUser);

        if ($abo) {
            if ($abo->etat_id == self::EN_COURS) {
                $abo->etat_id = self::STOP;
            } else {
                $abo->etat_id = self::EN_COURS;
            }
            $abo->save();
        } else {
            Abonnement::Create([
                'publication_id' => $idPub,
                'client_id' => $idUser,
                'etat_id' => self::EN_COURS,
                'paye_id' => self::PAYE,
                'date_fin' => Carbon::now()->addYear(),
            ]);
        }
    }

    public static function relance($idAbo) {
        $abo = Abonnement::find($idAbo);
        $abo->date_fin = $abo->date_fin->addYear();
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
    public static function getAbonnement($idPub, $idUser) {
        return Abonnement::where('publication_id', $idPub)->where('client_id' , $idUser)->first();
    }

    /**
     * Récupère la liste des abonnements en fonction de filtres
     * @param $filters
     * @param $isUser
     * @return list d'abonnements
     */
    public static function listAbonnements($filters, $IdUser) {

        $query = Abonnement::query();

        $query->where('client_id', $IdUser);
        $query->join('publications', 'publications.id', 'publication_id');

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

        $orderBy = 'abonnements.updated_at';
        $orderAsc = 'desc';

        $query->orderBy($orderBy, $orderAsc);

        return $query->get();
    }
}