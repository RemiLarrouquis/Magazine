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

        $abo = Abonnement::where('publication_id', $idPub)->where('client_id' , $idUser)->first();

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
}