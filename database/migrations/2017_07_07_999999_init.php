<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Création des status
        // Type 1 -------------------------------------------
        $statusSexeH = new \App\Status();
        $statusSexeH -> type = 1;
        $statusSexeH -> libelle = "Homme";
        $statusSexeH -> save();

        $statusSexeF = new \App\Status();
        $statusSexeF -> type = 1;
        $statusSexeF -> libelle = "Femme";
        $statusSexeF -> save();

        $statusSexeN = new \App\Status();
        $statusSexeN -> type = 1;
        $statusSexeN -> libelle = "Neutre";
        $statusSexeN -> save();

        // Type 2 -------------------------------------------
        $statusAboEnCours = new \App\Status();
        $statusAboEnCours -> type = 2;
        $statusAboEnCours -> libelle = "En cours";
        $statusAboEnCours -> save();

        $statusAboStop = new \App\Status();
        $statusAboStop -> type = 2;
        $statusAboStop -> libelle = "Stoppé";
        $statusAboStop -> save();

        $statusAboTermine = new \App\Status();
        $statusAboTermine -> type = 2;
        $statusAboTermine -> libelle = "Terminé";
        $statusAboTermine -> save();

        // Type 3 -------------------------------------------
        $statusAboPaye = new \App\Status();
        $statusAboPaye -> type = 3;
        $statusAboPaye -> libelle = "Payé";
        $statusAboPaye -> save();

        $statusAboImpaye = new \App\Status();
        $statusAboImpaye -> type = 3;
        $statusAboImpaye -> libelle = "Impayé";
        $statusAboImpaye -> save();

        $statusAboRemb = new \App\Status();
        $statusAboRemb -> type = 3;
        $statusAboRemb -> libelle = "Remboursé";
        $statusAboRemb -> save();

        // Création des utilisateurs
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

        // Création d'un client
        $client1 = new \App\User();
        $client1 -> name = "Client 1";
        $client1 -> email = "client1@test.fr";
        $client1 -> password = bcrypt('client1');
        $client1 -> save();

        $infoClient1 = new \App\InfoUser();
        $infoClient1 -> user_id = $client1->id;
        $infoClient1 -> sexe_id = $statusSexeH -> id;
        $infoClient1 -> nom = "Client";
        $infoClient1 -> prenom = "premier";
        $infoClient1 -> date_naissance = Carbon::createFromDate("2000", "02", "05", "0");
        $infoClient1 -> lieu_naissance = "Bordeaux";
        $infoClient1 -> adresse = "une adresse au numéro 5";
        $infoClient1 -> code_postal = "33000";
        $infoClient1 -> telephone = "0705252625";
        $infoClient1 -> save();

        // Création des publications avec fichiers
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

        // ------------------------------------------
        $fichier2 = new \App\Fichier();
        $fichier2 -> nom_fichier = "gq.JPG";
        $fichier2 -> nom_server = "gq.JPG";
        $fichier2 -> save();

        $publication2 = new \App\Publication();
        $publication2 -> fichier() -> associate($fichier2);
        $publication2 -> titre = "GQ";
        $publication2 -> nb_an = 11;
        $publication2 -> prix_an = 26;
        $publication2 -> description = "Le magazine propose une vision différente sur le quotidien et adopte un autre ton pour
         parler aux hommes des sujets qui les intéressent. Economie, politique, multimédia, mode, bons plans, déco informatique
          littérature, voyages, cinéma, écologie ... Entre sérieux et liberté, rêve et accessibilité, GQ est le magazine pour une
           génération d'hommes décomplexés, curieux et sensibles au monde qui les entoure.";
        $publication2 -> save();

        // ------------------------------------------
        $fichier3 = new \App\Fichier();
        $fichier3 -> nom_fichier = "spirou.JPG";
        $fichier3 -> nom_server = "spirou.JPG";
        $fichier3 -> save();

        $publication3 = new \App\Publication();
        $publication3 -> fichier() -> associate($fichier3);
        $publication3 -> titre = "Spirou";
        $publication3 -> nb_an = 12;
        $publication3 -> prix_an = 36;
        $publication3 -> description = "Retrouvez chaque semaine le meilleur de la BD pour toute la famille au travers des 52 pages du journal de Spirou. Découvrez en avant-première les aventures de vos héros de BD préférés : Le Marsupilami, le Petit Spirou, Les Tuniques Bleues, Les Nombrils, Seuls, Zombillénium, Kid Paddle et plein d'autres encore. ";
        $publication3 -> save();

        // ------------------------------------------
        $fichier4 = new \App\Fichier();
        $fichier4 -> nom_fichier = "animal.JPG";
        $fichier4 -> nom_server = "animal.JPG";
        $fichier4 -> save();

        $publication4 = new \App\Publication();
        $publication4 -> fichier() -> associate($fichier4);
        $publication4 -> titre = "60 millions de consommateurs";
        $publication4 -> nb_an = 12;
        $publication4 -> prix_an = 41;
        $publication4 -> description = "Pour comparer, choisir et acheter en parfaite connaissance de cause, vous pouvez compter sur 60 millions de consommateurs. Magazine de l’Institut national de la consommation, sans publicité, 60 millions de consommateurs vous délivre une information indépendante, impartiale et fiable indispensable pour mieux consommer et bien défendre vos droits.Selon la formule choisie, votre abonnement comprend11 numéros mensuels séquencés en 4 grandes rubriques.";
        $publication4 -> save();

        // ------------------------------------------
        $fichier5 = new \App\Fichier();
        $fichier5 -> nom_fichier = "parismatch.JPG";
        $fichier5 -> nom_server = "parismatch.JPG";
        $fichier5 -> save();

        $publication5 = new \App\Publication();
        $publication5 -> fichier() -> associate($fichier5);
        $publication5 -> titre = "Paris match";
        $publication5 -> nb_an = 10;
        $publication5 -> prix_an = 80;
        $publication5 -> description = "Témoin de l’histoire du monde depuis près de 60 ans, Paris Match fait vivre à des millions de lecteurs les grands moments de l’actualité. Reportages captivants, témoignages saisissants, avec Paris Match, partagez chaque semaine les émotions qui font la vie.";
        $publication5 -> save();

        // ------------------------------------------
        $fichier6 = new \App\Fichier();
        $fichier6 -> nom_fichier = "telerama.JPG";
        $fichier6 -> nom_server = "telerama.JPG";
        $fichier6 -> save();

        $publication6 = new \App\Publication();
        $publication6 -> fichier() -> associate($fichier6);
        $publication6 -> titre = "Télérama";
        $publication6 -> nb_an = 11;
        $publication6 -> prix_an = 99;
        $publication6 -> description = "Tout Télérama en un abonnement, c’est le meilleur de l’actualité culturelle. Un magazine qui vous accompagne dans toutes vos envies de culture : littérature, musique, cinéma, théâtre, art, télévision. des articles de fond, un ton inimitable et une communauté unique, pour exercer chaque jour un esprit critique sur la société ; des contenus exclusivement réservés aux abonnés sur telerama.fr";
        $publication6 -> save();

        $fichier7 = new \App\Fichier();
        $fichier7 -> nom_fichier = "empty.JPG";
        $fichier7 -> nom_server = "empty.JPG";
        $fichier7 -> save();


        // Création d'un abonnement
        $abonnement1 = new \App\Abonnement();
        $abonnement1 -> publication_id = $publication1 -> id;
        $abonnement1 -> client_id = $client1-> id;
        $abonnement1 -> etat_id = $statusAboEnCours -> id;
        $abonnement1 -> paye_id = $statusAboImpaye -> id;
        $abonnement1 -> date_fin = Carbon::createFromDate("2018", "02", "05", "0");
        $abonnement1 -> save();
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
