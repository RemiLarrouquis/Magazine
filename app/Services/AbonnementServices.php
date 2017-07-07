<?php

namespace App\Services;

use App\Abonnement;
use App\Paiement;
use App\Publication;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;

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
            if ($abo->etat_id == self::EN_COURS && (Carbon::parse($abo->date_fin) > Carbon::now())) {
                $abo->etat_id = self::ARRETER;
                $msg = "Abonnement arreté";
            } else {
                $abo->etat_id = self::EN_COURS;
                $abo->paye_id = self::IMPAYE;
                $abo->date_fin = Carbon::now()->addYear();
                // On s'abonne de nouveau, on créé donc un nouveau paiement
                $paie = self::createPaiement($abo);
                $msg = "Abonnement en cours";
            }
            $abo->save();
        } else {
            $msg = "Abonnement créé";
            $abo = Abonnement::Create([
                'publication_id' => $idPub,
                'client_id' => $idUser,
                'etat_id' => self::EN_COURS,
                'paye_id' => self::IMPAYE,
                'date_fin' => Carbon::now()->addYear(),
            ]);
            $paie = self::createPaiement($abo);
        }
        return $msg;
    }

    public static function newAbonnementDash($idPub, $idUser)
    {
        $msg = '';
        $abo = self::getAbonnement($idPub, $idUser);

        if ($abo) {
            $abo->etat_id = self::EN_COURS;
            $abo->paye_id = self::IMPAYE;
            $abo->date_fin = Carbon::now()->addYear();
            // On s'abonne de nouveau, on créé donc un nouveau paiement
            $paie = self::createPaiement($abo);
            $msg = "Abonnement en cours";

            $abo->save();
        } else {
            $msg = "Abonnement créé";
            $abo = Abonnement::Create([
                'publication_id' => $idPub,
                'client_id' => $idUser,
                'etat_id' => self::EN_COURS,
                'paye_id' => self::IMPAYE,
                'date_fin' => Carbon::now()->addYear(),
            ]);
            $paie = self::createPaiement($abo);
        }
        return $msg;
    }

    public static function createPaiement($abo)
    {
        $cid = PaiementServices::newCid(null);
        $pub = Publication::find($abo->publication_id);
        $paie = PaiementServices::newPaiement($abo->id, $abo->date_fin, $pub->prix_an, $cid);
        return $paie;
    }

    public static function relance($idAbo)
    {
        $abo = Abonnement::find($idAbo);
        $abo->date_fin = Carbon::parse($abo->date_fin)->addYear();
        $abo->paye_id = self::IMPAYE;
        $abo->etat_id = self::EN_COURS;
        $abo->save();
        $paie = self::createPaiement($abo);
    }

    public static function pause($idAbo)
    {
        $abo = Abonnement::find($idAbo);
        $abo->date_pause = Carbon::now();
        $abo->etat_id = self::PAUSE;
        $abo->save();
    }

    public static function repriseApresPause($idAbo)
    {
        $abo = Abonnement::find($idAbo);
        // $dureePause = (new DateTime($abo->date_fin))->diff((new DateTime($abo->date_pause)));
        // $abo->date_fin = (new DateTime($abo->date_fin))->add($dureePause);
        $abo->date_pause = null;
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
            'sexe.libelle_short as sexe_libelle', 'paye.libelle as paye_libelle', 'etat.libelle as etat_libelle',
            'etat.id as idEtat');

        // Etat (encours, stop, pause)
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
        if (array_key_exists('filtreTitre', $filters)) {
            $query->where(function ($q) use ($filters) {
                $q->where('publications.titre', 'like', '%' . $filters['filtreTitre'] . '%');
                $q->orWhere('publications.titre', 'like', '%' . strtoupper($filters['filtreTitre']) . '%');
                $q->orWhere('publications.titre', 'like', '%' . ucfirst($filters['filtreTitre']) . '%');
            });
        }

        $orders = self::orderByMultiple($filters);

        $query->orderBy($orders['orderBy'], $orders['orderAsc']);

        if ($paging) {
            return $query->paginate($paging);
        } else {
            return $query->get();
        }
    }

    /**
     * @param $filters
     * @return array
     */
    public static function orderByMultiple($filters)
    {
        $orderBy = 'abonnements.updated_at';
        $orderAsc = 'desc';

        if (array_key_exists('orderByDateFin', $filters)) {
            $orderBy = 'date_fin';
            if ($filters['orderByDateFin'] == "true") {
                $orderAsc = 'asc';
            } else {
                $orderAsc = 'desc';
            }
        }
        return array('orderBy' => $orderBy, 'orderAsc' => $orderAsc);
    }

    public static function listAboWithPaiement($filters, $idUser)
    {
        $abos = self::listAbonnements($filters, $idUser, false);

        foreach ($abos as $abo) {
            $abo->paiement = PaiementServices::liste($filters, $idUser, $abo->publication_id, null, false);
        }
        return $abos;
    }

    public static function checkStatusPaie($aboId)
    {

        $abo = Abonnement::where('id', $aboId)->first();
        $paies = PaiementServices::liste(null, null, null, $abo->id, false);

        $impaye = false;
        $rembourse = true;

        if (count($paies) > 0) {
            foreach ($paies as $paie) {
                // Si un paiement est impayé alors l'abonnement l'est aussi
                if ($paie->etat_id == self::IMPAYE) {
                    $impaye = true;
                    break;
                }
                // L'abonnement est remboursé si tous ces paiements le sont.
                if ($paie->etat_id != self::REMBOURSE) {
                    $rembourse = false;
                }
            }
        } else {
            $impaye = true;
        }
        if ($impaye) {
            $abo->paye_id = self::IMPAYE;
        } else if ($rembourse) {
            $abo->paye_id = self::REMBOURSE;
        } else {
            $abo->paye_id = self::PAYE;
        }
        $abo->save();
    }
}