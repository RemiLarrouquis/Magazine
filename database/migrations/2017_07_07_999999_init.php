<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userRemi = new \App\User();
        $userRemi -> name = "Remi L";
        $userRemi -> email = "remi@mag.fr";
        $userRemi -> password = bcrypt('remimag');
        $userRemi -> save();

        $userLudo = new \App\User();
        $userLudo -> name = "Ludovic G";
        $userLudo -> email = "ludovic@mag.fr";
        $userLudo -> password = bcrypt('ludovicmag');
        $userLudo -> save();

        $userVince = new \App\User();
        $userVince -> name = "Vincent G";
        $userVince -> email = "vincent@mag.fr";
        $userVince -> password = bcrypt('vincentmag');
        $userVince -> save();

        $userLoic = new \App\User();
        $userLoic -> name = "Loic B";
        $userLoic -> email = "loic@mag.fr";
        $userLoic -> password = bcrypt('loicmag');
        $userLoic -> save();

        $fichier1 = new \App\Fichier();
        $fichier1 -> nom_fichier = "tout_sur_lhistoire_viking.jpg";
        $fichier1 -> nom_server = "tout_sur_lhistoire_viking.jpg";
        $fichier1 -> save();

        $publication1 = new \App\Publication();
        $publication1 -> fichier() -> associate($fichier1);
        $publication1 -> titre = "Tout sur l'Histoire";
        $publication1 -> nb_an = 6;
        $publication1 -> prix_an = 34;
        $publication1 -> description = "Tout sur l'histoire : le magazine pour les passionnés d'histoire ou les curieux
Passionné d’Histoire ou simplement curieux d’apprendre ? Le magazine Tout sur l’Histoire est fait pour vous ! Grâce à des focus sur les événements et les personnages historiques majeurs, redécouvrez ceux qui ont marqué leur époque, pour votre plus grand plaisir.";
        $publication1 -> save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
