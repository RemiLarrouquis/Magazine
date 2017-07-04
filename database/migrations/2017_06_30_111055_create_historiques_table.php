<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriquesTable extends Migration
{
    public function up()
    {
        Schema::create('historiques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('employe_id');
            $table->integer('type_id');
            $table->text('description');
            $table->date('date');
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('historiques');
    }
}