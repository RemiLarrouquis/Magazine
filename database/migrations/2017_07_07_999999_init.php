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

        $publication7 = new \App\Publication();
        $publication7 -> fichier() -> associate($fichier7);
        $publication7 -> titre = "Magazine";
        $publication7 -> nb_an = 6;
        $publication7 -> prix_an = 35;
        $publication7 -> description = "Accédez au suivi de vos abonnements magazines pour connaître la date de fin de votre abonnement magazine. Profitez-en pour vous réabonner !";
        $publication7 -> save();


        $fichier8 = new \App\Fichier();
        $fichier8 -> nom_fichier = "psycho.JPG";
        $fichier8 -> nom_server = "psycho.JPG";
        $fichier8 -> save();

        $publication8 = new \App\Publication();
        $publication8 -> fichier() -> associate($fichier8);
        $publication8 -> titre = "Psychologies";
        $publication8 -> nb_an = 11;
        $publication8 -> prix_an = 26;
        $publication8 -> description = "Dans le contexte actuel plus compliqué pour tous, Psychologies magazine est un véritable atout !Il vous donne de nouveaux repères et vous offre un regard neuf sur votre vie… sur vous-même et sur les autres.";
        $publication8 -> save();

        $fichier9 = new \App\Fichier();
        $fichier9 -> nom_fichier = "premiere.JPG";
        $fichier9 -> nom_server = "premiere.JPG";
        $fichier9 -> save();

        $publication9 = new \App\Publication();
        $publication9 -> fichier() -> associate($fichier9);
        $publication9 -> titre = "Première";
        $publication9 -> nb_an = 6;
        $publication9 -> prix_an = 23;
        $publication9 -> description = "Chaque mois, retrouvez dans Première l’agenda des films, les box-offices en France et aux U.S.A., les brèves sur les tournages français et américains, les coups de cœur de la rédaction, des interviews et reportages, les prévisions de sortie, les fiches cinéma et deux affiches de film.";
        $publication9 -> save();

        $fichier10 = new \App\Fichier();
        $fichier10 -> nom_fichier = "tele7.JPG";
        $fichier10 -> nom_server = "tele7.JPG";
        $fichier10 -> save();

        $publication10 = new \App\Publication();
        $publication10 -> fichier() -> associate($fichier10);
        $publication10 -> titre = "Télé 7 Jours";
        $publication10 -> nb_an = 52;
        $publication10 -> prix_an = 41;
        $publication10 -> description = "Chaque semaine recevez chez vous le plus attractif des magazines télé. Laissez-vous guider par les grilles de programmes complètes et conviviales de toutes les chaînes, y compris câble et satellites.Avec TELE 7 JOURS vous serez informé par nos nombreux commentaires. ";
        $publication10 -> save();

        $fichier11 = new \App\Fichier();
        $fichier11 -> nom_fichier = "camping.JPG";
        $fichier11 -> nom_server = "camping.JPG";
        $fichier11 -> save();

        $publication11 = new \App\Publication();
        $publication11 -> fichier() -> associate($fichier11);
        $publication11 -> titre = "Camping Car Magazine";
        $publication11 -> nb_an = 1;
        $publication11 -> prix_an = 35;
        $publication11 -> description = "Actualité, essais, enquêtes et dossiers : nouveaux modèles, réglementation... tout ce qui de passe dans le monde des camping-caristes.Equipement, fiches pratiques : petits gadgets ou grandes innovations, découvrez les technologies et les idées simples qui vous facilitent la vie...";
        $publication11 -> save();


        $fichier12 = new \App\Fichier();
        $fichier12 -> nom_fichier = "cheval.JPG";
        $fichier12 -> nom_server = "cheval.JPG";
        $fichier12 -> save();

        $publication12 = new \App\Publication();
        $publication12 -> fichier() -> associate($fichier12);
        $publication12 -> titre = "Cheval Pratique";
        $publication12 -> nb_an = 12;
        $publication12 -> prix_an = 56;
        $publication12 -> description = "Depuis 1990, Cheval Pratique apporte à tous ceux qui aiment les chevaux les informations indispensables pour vivre pleinement leur passion. Les journalistes, tous cavaliers, travaillent en collaboration avec des intervenants professionnels qui comptent parmi les meilleurs du monde équestre.";
        $publication12 -> save();


        $fichier13 = new \App\Fichier();
        $fichier13 -> nom_fichier = "jeux.JPG";
        $fichier13 -> nom_server = "jeux.JPG";
        $fichier13 -> save();

        $publication13 = new \App\Publication();
        $publication13 -> fichier() -> associate($fichier13);
        $publication13 -> titre = "Jeux Vidéo Magazine";
        $publication13 -> nb_an = 12;
        $publication13 -> prix_an = 31;
        $publication13 -> description = "Jeux Vidéo Magazine est le magazine de jeux vidéo français le plus vendu. Ilest consacré au jeu vidéo sous toutes ses formes et sur tous ses supports :consoles, PC, nomades, online, mobiles et tablettes. Tous les mois retrouveztoute l’actualité du jeu vidéo : des actus, des dossiers, des enquêtes et biensûr les tests de tous les jeux";
        $publication13 -> save();


        $fichier14 = new \App\Fichier();
        $fichier14 -> nom_fichier = "minou.JPG";
        $fichier14 -> nom_server = "minou.JPG";
        $fichier14 -> save();

        $publication14 = new \App\Publication();
        $publication14 -> fichier() -> associate($fichier14);
        $publication14 -> titre = "Terre Sauvage";
        $publication14 -> nb_an = 12;
        $publication14 -> prix_an = 55;
        $publication14 -> description = "Avec [Terre Sauvage], partez à la découverte de notre planète dans ce qu’elle a de plus authentique, de plus fragile, de plus vivant : sa nature sauvage !Rencontres étonnantes entre les hommes et les animaux, récits d’aventuriers hors du commun, exploration sportive des terres extrêmes";
        $publication14 -> save();
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
