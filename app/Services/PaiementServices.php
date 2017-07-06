<?php

namespace App\Services;

use App\Abonnement;
use App\Paiement;

class PaiementServices
{
    const PAYE = 7;
    const IMPAYE = 8;
    const REMBOURSE = 9;

    const IDENTIFIANT = 'a7111252-62b2-9ff7-5487-9d7c0c6b9b21';
    const IP = '10.0.0.6';
    const PORT = '6543';
    const PROTOCOLE = 'HTTP';

    public static function liste($filters, $idUser, $idPub, $idAbo, $paging)
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
            'users.nom', 'users.prenom',
            'etatPaie.libelle as etatPaie_libelle', 'etatPaie.id as idEtatPaie',
            'etatAbo.libelle as etatAbo_libelle', 'etatAbo.id as idEtatAbo',
            'payeAbo.libelle as paye_libelle');


        if ($idUser) {
            $query->where('client_id', $idUser);
        }
        if ($idPub) {
            $query->where('publication_id', $idPub);
        }
        if ($idAbo) {
            $query->where('abonnement_id', $idAbo);
        }

        $query->orderBy('paiements.created_at', 'asc');

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
        $paie->etat_id = self::IMPAYE;
        $paie->cid = $cid;
        $paie->save();

        // Met à jours le status de l'abonnement
        AbonnementServices::checkStatusPaie($paie->abonnement_id);

        return $paie;
    }

    public static function sendPaiement($cid) {
        $paie = self::getPaiementByCid($cid);
        $paie->etat_id = self::PAYE;
        $paie->valider = false;
        $paie->save();
        return $paie;
    }

    public static function errorPaiement($cid) {
        $paie = self::getPaiementByCid($cid);
        $paie->etat_id = self::IMPAYE;
        $paie->save();
        return $paie;
    }

    public static function validePaiement($cid, $transac) {
        $paie = self::getPaiementByCid($cid);
        $paie->transaction = $transac;
        $paie->valider = true;
        $paie->save();

        // Met à jours le status de l'abonnement
        AbonnementServices::checkStatusPaie($paie->abonnement_id);

        return $paie;
    }

    public static function remboursementPaiement($cid, $amount) {
        $paie = self::getPaiementByCid($cid);
        if ($amount) {
            $paie->montant = $paie->montant - $amount;
        } else {
            $paie->montant = 0;
        }
        $paie->etat_id = self::REMBOURSE;
        $paie->save();

        // Met à jours le status de l'abonnement
        AbonnementServices::checkStatusPaie($paie->abonnement_id);

        return $paie;
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

    public static function prepareUrlPaye($paie, $cardNumber, $cardMonth, $cardyear) {
        return self::IP.':'.self::PORT.'/cardpay/'.self::IDENTIFIANT.'/'.$paie->cid.'/'.$cardNumber.'/'.$cardMonth.'/'.$cardyear.'/'.$paie->montant;
    }
}