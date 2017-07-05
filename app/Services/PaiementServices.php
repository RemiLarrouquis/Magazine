<?php

namespace App\Services;

use App\Abonnement;
use App\Paiement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;

class AbonnementServices
{
    const PAYE = 7;
    const IMPAYE = 8;
    const REMBOURSE = 9;

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
        $paie = Paiement::where('cid', $cid)->first();
        $paie->etat = self::PAYE;
        $paie->valider = false;
        $paie->save();
    }

    public static function validePaiement($cid, $transac) {
        $paie = Paiement::where('cid', $cid)->first();
        $paie->transaction = $transac;
        $paie->valider = true;
        $paie->save();
    }

    public static function newCid($prefix) {
        if ($prefix) {
            return uniqid($prefix);
        } else {
            return uniqid();
        }
    }
}