<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id('idE');
            $table->string('titrePoste',100);
           
            $table->foreignId('profil')
            ->constrained()
            ->on('profils')
            ->references('id')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->text('missionP');
            $table->string('type',20)->nullable();
            $table->date('dateDebut')->nullable();
            $table->date('dateFin')->nullable();
            $table->float('score')->nullable();
            $table->string('entreprise',100)->nullable();
            $table->text('adresse')->nullable();
            $table->string('pays',100)->default('maroc');
            $table->string('ville')->nullable();
            $table->string('logoEntreprise')->nullable();
            $table->string('jointureDip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiences');
    }
};
