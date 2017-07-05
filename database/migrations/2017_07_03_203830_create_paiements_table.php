<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('abonnement_id');
            $table->date('date_fin'); // -1 an nous donne la période de l'abo pour le paiement
            $table->integer('etat_id'); // Status de type payer, impaye, rembourse
            $table->boolean('valider')->default(false);
            $table->float('montant');
            $table->text('transaction')->nullable();
            $table->text('cid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}
