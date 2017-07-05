<?php

namespace App\Services;

use App\Paiement;

class PaiementServices
{
    const PAYE = 7;
    const IMPAYE = 8;
    const REMBOURSE = 9;

    public static function liste($filters, $idUser, $idPub, $paging)
    {
        $query = Paiement::query();
        $query->join('abonnements', 'abonnements.id', 'abonnement_id');
        $query->join('publications', 'publications.id', 'publication_id');
        $query->join('users', 'users.id', 'client_id');
        $query->join('statuses as etatAbo', 'etatAbo.id', 'abonnements.etat_id');
        $query->join('statuses as etatPaie', 'etatPaie.id', 'paiements.etat_id');
        $query->join('statuses as payeAbo', 'payeAbo.id', 'abonnements.paye_id');
        $query->select(
            'paiements.*',
            'publications.titre', 'publications.id as idPub',
            'publications.nb_an', 'publications.prix_an',
            'users.nom', 'users.prenom', 'sexe.libelle_short as sexe_libelle',
            'paye.libelle as paye_libelle', 'etat.libelle as etat_libelle', 'etat.id as idEtat');


        if ($idUser) {
            $query->where('client_id', $idUser);
        }
        if ($idPub) {
            $query->where('publication_id', $idPub);
        }

        $query->orderBy('paiements.created_at', 'desc');

        if ($paging) {
            return $query->paginate($paging);
        } else {
            return $query->get();
        }
    }

    public static function newPaiement($abo_id, $date_fin, $montant, $cid) {
        $paie = new \App\Paiement();
        $paie->abonnement_id = $abo_id;
        $paie->date_fin = $date_fin;
        $paie->montant = $montant;
        $paie->etat = self::IMPAYE;
        $paie->cid = $cid;
        $paie->save();
    }

    public static function sendPaiement($cid) {
        $paie = self::getPaiementByCid($cid);
        $paie->etat = self::PAYE;
        $paie->valider = false;
        $paie->save();
    }

    public static function validePaiement($cid, $transac) {
        $paie = self::getPaiementByCid($cid);
        $paie->transaction = $transac;
        $paie->valider = true;
        $paie->save();
    }

    public static function remboursementPaiement($cid, $amount) {
        $paie = self::getPaiementByCid($cid);
        if ($amount) {
            $paie->montant = $paie->montant - $amount;
        } else {
            $paie->montant = 0;
        }
        $paie->etat = self::REMBOURSE;
        $paie->save();
    }

    private static function getPaiementByCid($cid) {
        return Paiement::where('cid', $cid)->first();
    }

    public static function newCid($prefix) {
        if ($prefix) {
            return uniqid($prefix);
        } else {
            return uniqid();
        }
    }
}