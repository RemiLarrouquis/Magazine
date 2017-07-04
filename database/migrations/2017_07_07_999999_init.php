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
        $this->statusSexe();

        // Type 2 -------------------------------------------
        $this->statusAboEtat();

        // Type 3 -------------------------------------------
        $this->statusAboPaye();

        // Type 4 -------------------------------------------
        $this->statusHistorique();

        // Création des utilisateurs
        $this->createEmployees();

        // Création de clients
        $this->createClients();

        // Création des publications
        $this->createPublications();

        // Pour Client "Client1"
        $this->createAbonnement(2, 3, 4, 7, date('Y-m-d', strtotime("15 July 2017")));
        $this->createAbonnement(4, 3, 4, 7, date('Y-m-d', strtotime("02 August 2017")));
        $this->createAbonnement(5, 3, 4, 7, $this->randomDate(false));
        $this->createAbonnement(7, 3, 4, 9, $this->randomDate(false));
        $this->createAbonnement(10, 3, 6, 7, $this->randomDate(false));
        $this->createAbonnement(13, 3, 6, 9, $this->randomDate(false));

        // Création d'abonnements
        for ($i = 0; $i < 60; $i++) {
            $this->createAbonnement(rand(1, 14), rand(4, 31), $this->randEven(4, 6), $this->randOdd(7, 9), $this->randomDate(false));
        }

        //Création d'historique
        for ($i = 0; $i < 100; $i++) {
            $this->createHistorique(rand(3, 31), rand(1, 2),rand(10, 13), 'Echange avec le client', $this->randomDate(true));
        }

        // Création d'un client spécial
        $clientTous = new \App\User();
        $clientTous->id = 100;
        $clientTous->nom = "Tous";
        $clientTous->email = "tous@tous.fr";
        $clientTous->password = bcrypt('aqwzsxedc147852963');
        $clientTous->is_client = false;
        $clientTous->save();
    }

    private function getBase64FromPath($img)
    {
        $image = 'C:\laragon\www\Magazine\public\uploads\\' . $img;
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $dataUri;
    }

    private function randomDate($beforeOnly)
    {
        // Convert to timetamps
        $min = strtotime("01 January 2016");
        if ($beforeOnly) {
            $max = strtotime("01 July 2017");
        } else {
            $max = strtotime("27 December 2018");
        }

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d', $val);
    }

    private function randEven($min, $max)
    {
        $rand = rand($min, $max);
        if ($rand % 2 == 0) {
            return $rand;
        } else {
            return $rand - 1;
        }
    }

    private function randOdd($min, $max)
    {
        $rand = rand($min, $max);
        if ($rand % 2 == 1) {
            return $rand;
        } else {
            return $rand - 1;
        }
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

    public function statusSexe()
    {
        $statusSexeH = new \App\Status();
        $statusSexeH->type = 1;
        $statusSexeH->libelle = "Homme";
        $statusSexeH->libelle_short = "Mr";
        $statusSexeH->save();
        $statusSexeF = new \App\Status();
        $statusSexeF->type = 1;
        $statusSexeF->libelle = "Femme";
        $statusSexeF->libelle_short = "Mme";
        $statusSexeF->save();
        $statusSexeN = new \App\Status();
        $statusSexeN->type = 1;
        $statusSexeN->libelle = "Autre";
        $statusSexeN->libelle_short = "";
        $statusSexeN->save();
    }

    public function statusAboEtat()
    {
        $statusAboEnCours = new \App\Status();
        $statusAboEnCours->type = 2;
        $statusAboEnCours->libelle = "Actif";
        $statusAboEnCours->save();
        $statusAboPause = new \App\Status();
        $statusAboPause->type = 2;
        $statusAboPause->libelle = "En pause";
        $statusAboPause->save();
        $statusAboTermine = new \App\Status();
        $statusAboTermine->type = 2;
        $statusAboTermine->libelle = "Arrêté";
        $statusAboTermine->save();
    }

    public function statusAboPaye()
    {
        $statusAboPaye = new \App\Status();
        $statusAboPaye->type = 3;
        $statusAboPaye->libelle = "Payé";
        $statusAboPaye->save();
        $statusAboImpaye = new \App\Status();
        $statusAboImpaye->type = 3;
        $statusAboImpaye->libelle = "Impayé";
        $statusAboImpaye->save();
        $statusAboRemb = new \App\Status();
        $statusAboRemb->type = 3;
        $statusAboRemb->libelle = "Remboursé";
        $statusAboRemb->save();
    }

    public function statusHistorique()
    {
        $statusAboPaye = new \App\Status();
        $statusAboPaye->type = 4;
        $statusAboPaye->libelle = "Email";
        $statusAboPaye->save();
        $statusAboImpaye = new \App\Status();
        $statusAboImpaye->type = 4;
        $statusAboImpaye->libelle = "Téléphone";
        $statusAboImpaye->save();
        $statusAboRemb = new \App\Status();
        $statusAboRemb->type = 4;
        $statusAboRemb->libelle = "Messagerie";
        $statusAboRemb->save();
        $statusAboRemb = new \App\Status();
        $statusAboRemb->type = 4;
        $statusAboRemb->libelle = "Autre";
        $statusAboRemb->save();
    }

    public function createEmployees()
    {
        $userRemi = new \App\User();
        $userRemi->nom = "Remi L";
        $userRemi->email = "remi@mag.fr";
        $userRemi->password = bcrypt('remimag');
        $userRemi->save();

        $userLudo = new \App\User();
        $userLudo->nom = "Ludovic G";
        $userLudo->email = "ludovic@mag.fr";
        $userLudo->password = bcrypt('ludovicmag');
        $userLudo->save();
    }

    /**
     * Création de 31 clients
     */
    public function createClients()
    {
        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Client";
        $client1->prenom = "premier";
        $client1->email = "client1@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = Carbon::createFromDate("2000", "02", "05", "0");
        $client1->lieu_naissance = "Bordeaux";
        $client1->adresse = "une adresse au numéro 5";
        $client1->code_postal = "33000";
        $client1->telephone = "07 05 25 26 25";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Herve";
        $client1->prenom = "Malo";
        $client1->email = "maloherve@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = false;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Les Salles-Lavauguyon";
        $client1->adresse = "166 Cité Beaurepaire";
        $client1->code_postal = "87440";
        $client1->telephone = "06 07 15 43 61";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Bayle";
        $client1->prenom = "Maéva";
        $client1->email = "maevabayle@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Saint-Genis-les-Ollières";
        $client1->adresse = "182 Rue Bellart";
        $client1->code_postal = "69290";
        $client1->telephone = "06 14 14 35 06";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Simon";
        $client1->prenom = "Nolan";
        $client1->email = "nolansimon@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Châtenay-Malabry";
        $client1->adresse = "101 Rue Gustave-Flaubert";
        $client1->code_postal = "92290";
        $client1->telephone = "06 00 20 43 29";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Girault";
        $client1->prenom = "Gilbert";
        $client1->email = "gilbertgirault@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Rignac";
        $client1->adresse = "96 Rue Baudricourt";
        $client1->code_postal = "12390";
        $client1->telephone = "06 78 36 39 91";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Lucas";
        $client1->prenom = "Léonie";
        $client1->email = "leonielucas@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = false;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Villeneuve-de-la-Raho";
        $client1->adresse = "168 Rue Doudeauville";
        $client1->code_postal = "66180";
        $client1->telephone = "06 53 15 99 28";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Wagner";
        $client1->prenom = "Émilie";
        $client1->email = "emiliewagner@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Gervans";
        $client1->adresse = "176 Rue Gaston-Boissier";
        $client1->code_postal = "26600";
        $client1->telephone = "06 91 26 38 11";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Joubert";
        $client1->prenom = "Marwane";
        $client1->email = "marwanejoubert@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Saint-Germain-la-Blanche-Herbe";
        $client1->adresse = "50 Villa Daumesnil";
        $client1->code_postal = "14280";
        $client1->telephone = "06 58 93 29 89";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Antoine";
        $client1->prenom = "Titouan";
        $client1->email = "titouanantoine@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Vicq";
        $client1->adresse = "22 Rue du Figuier";
        $client1->code_postal = "59970";
        $client1->telephone = "06 57 39 39 45";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Besnard";
        $client1->prenom = "Carla";
        $client1->email = "carlabesnard@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Valay";
        $client1->adresse = "22 Rue Duranton";
        $client1->code_postal = "70140";
        $client1->telephone = "06 63 97 11 83";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Combes";
        $client1->prenom = "Esteban";
        $client1->email = "estebancombes@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Luneray";
        $client1->adresse = "183 Rue Gaston-Tessier";
        $client1->code_postal = "76810";
        $client1->telephone = "06 99 65 72 32";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Marquet";
        $client1->prenom = "Thibault";
        $client1->email = "thibaultmarquet@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = false;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Villers-aux-Érables";
        $client1->adresse = "167 Rue de l'Industrie";
        $client1->code_postal = "80110";
        $client1->telephone = "06 79 41 47 81";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Le corre";
        $client1->prenom = "Lilian";
        $client1->email = "lilianle.corre@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Vendin-lès-Béthune";
        $client1->adresse = "137 Rue Caillié";
        $client1->code_postal = "62232";
        $client1->telephone = "06 32 96 04 65";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Simon";
        $client1->prenom = "Capucine";
        $client1->email = "capucinesimon@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "La Ferrière-sur-Risle";
        $client1->adresse = "23 Rue de l'Adjudant-Réau";
        $client1->code_postal = "27760";
        $client1->telephone = "06 09 88 84 48";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Merle";
        $client1->prenom = "Syrine";
        $client1->email = "syrinemerle@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Les Vans";
        $client1->adresse = "89 Rue de Longchamp";
        $client1->code_postal = "07140";
        $client1->telephone = "06 29 55 98 72";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Blondel";
        $client1->prenom = "Julie";
        $client1->email = "julieblondel@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Vennezey";
        $client1->adresse = "24 Rue Gustave-Goublier";
        $client1->code_postal = "54830";
        $client1->telephone = "06 31 78 53 04";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Guyot";
        $client1->prenom = "Benjamin";
        $client1->email = "benjaminguyot@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Saint-Quentin-de-Baron";
        $client1->adresse = "150 Rue de Chablis";
        $client1->code_postal = "33750";
        $client1->telephone = "06 67 20 35 54";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Delorme";
        $client1->prenom = "Julien";
        $client1->email = "juliendelorme@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = false;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Murol";
        $client1->adresse = "168 Rue Cadet";
        $client1->code_postal = "63790";
        $client1->telephone = "06 21 79 92 91";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Morvan";
        $client1->prenom = "Maëlle";
        $client1->email = "maellemorvan@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Novalaise";
        $client1->adresse = "14 Rue de l'Abbé-Rousselot";
        $client1->code_postal = "73470";
        $client1->telephone = "06 48 82 11 72";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Moreno";
        $client1->prenom = "Noémie";
        $client1->email = "noemiemoreno@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Sailly-lez-Lannoy";
        $client1->adresse = "91 Rue du Docteur-Tuffier";
        $client1->code_postal = "59390";
        $client1->telephone = "06 11 66 37 01";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Fischer";
        $client1->prenom = "Angelina";
        $client1->email = "angelinafischer@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Juvisy-sur-Orge";
        $client1->adresse = "1 Rue Guillaume-Bertrand";
        $client1->code_postal = "91260";
        $client1->telephone = "06 90 30 72 65";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Bodin";
        $client1->prenom = "Lisa";
        $client1->email = "lisabodin@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Saint-Étienne-de-Tulmont";
        $client1->adresse = "181 Rue Dufrenoy";
        $client1->code_postal = "82410";
        $client1->telephone = "06 83 65 98 99";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Poisson";
        $client1->prenom = "Anna";
        $client1->email = "annapoisson@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Le Pin";
        $client1->adresse = "144 Rue du Docteur-Victor-Hutinel";
        $client1->code_postal = "14590";
        $client1->telephone = "06 55 74 82 02";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Neveu";
        $client1->prenom = "Killian";
        $client1->email = "killianneveu@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Vouzeron";
        $client1->adresse = "61 Boulevard d'Algérie";
        $client1->code_postal = "18330";
        $client1->telephone = "06 35 12 39 66";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Langlois";
        $client1->prenom = "Mélanie";
        $client1->email = "melanielanglois@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Les Trois Pierres";
        $client1->adresse = "186 Impasse Cels";
        $client1->code_postal = "76430";
        $client1->telephone = "06 05 82 57 84";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Godin";
        $client1->prenom = "Célia";
        $client1->email = "celiagodin@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Salouël";
        $client1->adresse = "7 Passage Gauthier";
        $client1->code_postal = "80480";
        $client1->telephone = "06 94 07 02 87";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Lombard";
        $client1->prenom = "Constant";
        $client1->email = "constantlombard@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Vieux-Boucau-les-Bains";
        $client1->adresse = "55 Rue Gazan";
        $client1->code_postal = "40480";
        $client1->telephone = "06 08 36 98 61";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Verdier";
        $client1->prenom = "Dorian";
        $client1->email = "dorianverdier@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Sains-du-Nord";
        $client1->adresse = "12 Rue des Fermiers";
        $client1->code_postal = "59177";
        $client1->telephone = "06 65 63 20 02";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Berger";
        $client1->prenom = "Juliette";
        $client1->email = "julietteberger@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "La Vancelle";
        $client1->adresse = "34 Rue Henri-Dubouillon";
        $client1->code_postal = "67730";
        $client1->telephone = "06 60 32 51 11";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Allard";
        $client1->prenom = "Victor";
        $client1->email = "victorallard@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = false;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Toulouse";
        $client1->adresse = "78 Square Henri-Duparc";
        $client1->code_postal = "31400";
        $client1->telephone = "06 90 47 75 16";
        $client1->save();

        $client1 = new \App\User();
        $client1->sexe_id = rand(1, 3);
        $client1->nom = "Meyer";
        $client1->prenom = "Corentin";
        $client1->email = "corentinmeyer@test.fr";
        $client1->password = bcrypt('client1');
        $client1->is_client = true;
        $client1->mail_confirm = true;
        $client1->date_naissance = $this->randomDate(true);
        $client1->lieu_naissance = "Le Vaulmier";
        $client1->adresse = "48 Rue Ernest-Cresson";
        $client1->code_postal = "15380";
        $client1->telephone = "06 56 99 31 57";
        $client1->save();


    }

    /**
     * @param $publication1
     * @param $client1
     * @param $statusAboEtat
     * @param $statusAboPaye
     */
    public function createAbonnement($publicationId, $clientId, $statusAboEtatId, $statusAboPayeId, $dateFin)
    {
        $abonnement1 = new \App\Abonnement();
        $abonnement1->publication_id = $publicationId;
        $abonnement1->client_id = $clientId;
        $abonnement1->etat_id = $statusAboEtatId;
        $abonnement1->paye_id = $statusAboPayeId;
        $abonnement1->date_fin = $dateFin;
        $abonnement1->save();
    }

    public function createHistorique($client_id, $employe_id, $type_id, $description, $date)
    {
        $historique1 = new \App\Historique();
        $historique1->client_id = $client_id;
        $historique1->employe_id = $employe_id;
        $historique1->type_id = $type_id;
        $historique1->description = $description;
        $historique1->date = $date;
        $historique1->save();
    }

    /**
     * @return \App\Publication
     */
    public function createPublications()
    {
        $publication1 = new \App\Publication();
        $publication1->image = $this->getBase64FromPath("tout_sur_lhistoire_viking.jpg");
        $publication1->titre = "Tout sur l'Histoire";
        $publication1->nb_an = 6;
        $publication1->prix_an = 34;
        $publication1->description = "Tout sur l'histoire : le magazine pour les passionnés d'histoire ou les curieux
Passionné d’Histoire ou simplement curieux d’apprendre ? Le magazine Tout sur l’Histoire est fait pour vous ! Grâce à des focus sur les événements et les personnages historiques majeurs, redécouvrez ceux qui ont marqué leur époque, pour votre plus grand plaisir.";
        $publication1->save();

        $publication2 = new \App\Publication();
        $publication2->image = $this->getBase64FromPath("gq.JPG");
        $publication2->titre = "GQ";
        $publication2->nb_an = 11;
        $publication2->prix_an = 26;
        $publication2->description = "Le magazine propose une vision différente sur le quotidien et adopte un autre ton pour
         parler aux hommes des sujets qui les intéressent. Economie, politique, multimédia, mode, bons plans, déco informatique
          littérature, voyages, cinéma, écologie ... Entre sérieux et liberté, rêve et accessibilité, GQ est le magazine pour une
           génération d'hommes décomplexés, curieux et sensibles au monde qui les entoure.";
        $publication2->save();

        $publication3 = new \App\Publication();
        $publication3->image = $this->getBase64FromPath("spirou.JPG");
        $publication3->titre = "Spirou";
        $publication3->nb_an = 12;
        $publication3->prix_an = 36;
        $publication3->description = "Retrouvez chaque semaine le meilleur de la BD pour toute la famille au travers des 52 pages du journal de Spirou. Découvrez en avant-première les aventures de vos héros de BD préférés : Le Marsupilami, le Petit Spirou, Les Tuniques Bleues, Les Nombrils, Seuls, Zombillénium, Kid Paddle et plein d'autres encore. ";
        $publication3->save();

        $publication4 = new \App\Publication();
        $publication4->image = $this->getBase64FromPath("animal.JPG");
        $publication4->titre = "60 millions de consommateurs";
        $publication4->nb_an = 12;
        $publication4->prix_an = 41;
        $publication4->description = "Pour comparer, choisir et acheter en parfaite connaissance de cause, vous pouvez compter sur 60 millions de consommateurs. Magazine de l’Institut national de la consommation, sans publicité, 60 millions de consommateurs vous délivre une information indépendante, impartiale et fiable indispensable pour mieux consommer et bien défendre vos droits.Selon la formule choisie, votre abonnement comprend11 numéros mensuels séquencés en 4 grandes rubriques.";
        $publication4->save();

        $publication5 = new \App\Publication();
        $publication5->image = $this->getBase64FromPath("parismatch.JPG");
        $publication5->titre = "Paris match";
        $publication5->nb_an = 10;
        $publication5->prix_an = 80;
        $publication5->description = "Témoin de l’histoire du monde depuis près de 60 ans, Paris Match fait vivre à des millions de lecteurs les grands moments de l’actualité. Reportages captivants, témoignages saisissants, avec Paris Match, partagez chaque semaine les émotions qui font la vie.";
        $publication5->save();

        $publication6 = new \App\Publication();
        $publication6->image = $this->getBase64FromPath("telerama.JPG");
        $publication6->titre = "Télérama";
        $publication6->nb_an = 11;
        $publication6->prix_an = 99;
        $publication6->description = "Tout Télérama en un abonnement, c’est le meilleur de l’actualité culturelle. Un magazine qui vous accompagne dans toutes vos envies de culture : littérature, musique, cinéma, théâtre, art, télévision. des articles de fond, un ton inimitable et une communauté unique, pour exercer chaque jour un esprit critique sur la société ; des contenus exclusivement réservés aux abonnés sur telerama.fr";
        $publication6->save();

        $publication7 = new \App\Publication();
        $publication7->image = $this->getBase64FromPath("empty.JPG");
        $publication7->titre = "Magazine";
        $publication7->nb_an = 6;
        $publication7->prix_an = 35;
        $publication7->description = "Accédez au suivi de vos abonnements magazines pour connaître la date de fin de votre abonnement magazine. Profitez-en pour vous réabonner !";
        $publication7->save();

        $publication8 = new \App\Publication();
        $publication8->image = $this->getBase64FromPath("psycho.JPG");
        $publication8->titre = "Psychologies";
        $publication8->nb_an = 11;
        $publication8->prix_an = 26;
        $publication8->description = "Dans le contexte actuel plus compliqué pour tous, Psychologies magazine est un véritable atout !Il vous donne de nouveaux repères et vous offre un regard neuf sur votre vie… sur vous-même et sur les autres.";
        $publication8->save();

        $publication9 = new \App\Publication();
        $publication9->image = $this->getBase64FromPath("premiere.JPG");
        $publication9->titre = "Première";
        $publication9->nb_an = 6;
        $publication9->prix_an = 23;
        $publication9->description = "Chaque mois, retrouvez dans Première l’agenda des films, les box-offices en France et aux U.S.A., les brèves sur les tournages français et américains, les coups de cœur de la rédaction, des interviews et reportages, les prévisions de sortie, les fiches cinéma et deux affiches de film.";
        $publication9->save();

        $publication10 = new \App\Publication();
        $publication10->image = $this->getBase64FromPath("tele7.JPG");
        $publication10->titre = "Télé 7 Jours";
        $publication10->nb_an = 52;
        $publication10->prix_an = 41;
        $publication10->description = "Chaque semaine recevez chez vous le plus attractif des magazines télé. Laissez-vous guider par les grilles de programmes complètes et conviviales de toutes les chaînes, y compris câble et satellites.Avec TELE 7 JOURS vous serez informé par nos nombreux commentaires. ";
        $publication10->save();

        $publication11 = new \App\Publication();
        $publication11->image = $this->getBase64FromPath("camping.JPG");
        $publication11->titre = "Camping Car Magazine";
        $publication11->nb_an = 1;
        $publication11->prix_an = 35;
        $publication11->description = "Actualité, essais, enquêtes et dossiers : nouveaux modèles, réglementation... tout ce qui de passe dans le monde des camping-caristes.Equipement, fiches pratiques : petits gadgets ou grandes innovations, découvrez les technologies et les idées simples qui vous facilitent la vie...";
        $publication11->save();

        $publication12 = new \App\Publication();
        $publication12->image = $this->getBase64FromPath("cheval.JPG");
        $publication12->titre = "Cheval Pratique";
        $publication12->nb_an = 12;
        $publication12->prix_an = 56;
        $publication12->description = "Depuis 1990, Cheval Pratique apporte à tous ceux qui aiment les chevaux les informations indispensables pour vivre pleinement leur passion. Les journalistes, tous cavaliers, travaillent en collaboration avec des intervenants professionnels qui comptent parmi les meilleurs du monde équestre.";
        $publication12->save();

        $publication13 = new \App\Publication();
        $publication13->image = $this->getBase64FromPath("jeux.JPG");
        $publication13->titre = "Jeux Vidéo Magazine";
        $publication13->nb_an = 12;
        $publication13->prix_an = 31;
        $publication13->description = "Jeux Vidéo Magazine est le magazine de jeux vidéo français le plus vendu. Ilest consacré au jeu vidéo sous toutes ses formes et sur tous ses supports :consoles, PC, nomades, online, mobiles et tablettes. Tous les mois retrouveztoute l’actualité du jeu vidéo : des actus, des dossiers, des enquêtes et biensûr les tests de tous les jeux";
        $publication13->save();

        $publication14 = new \App\Publication();
        $publication14->image = $this->getBase64FromPath("minou.JPG");
        $publication14->titre = "Terre Sauvage";
        $publication14->nb_an = 12;
        $publication14->prix_an = 55;
        $publication14->description = "Avec [Terre Sauvage], partez à la découverte de notre planète dans ce qu’elle a de plus authentique, de plus fragile, de plus vivant : sa nature sauvage !Rencontres étonnantes entre les hommes et les animaux, récits d’aventuriers hors du commun, exploration sportive des terres extrêmes";
        $publication14->save();
    }
}
