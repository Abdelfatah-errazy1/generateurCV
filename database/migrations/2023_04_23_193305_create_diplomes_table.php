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
        Schema::create('diplomes', function (Blueprint $table) {
            $table->id('idD');
            $table->string('titre',100);
            $table->foreignId('secteur')
            ->constrained()
            ->on('secteursspects')
            ->references('idS')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('profil')
            ->constrained()
            ->on('profils')
            ->references('id')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->string('niveau',150);
            $table->float('score')->nullable();
            $table->string('mention',100)->nullable();
            $table->date('dateDebut')->nullable();
            $table->date('dateFin')->nullable();
            $table->string('organismeDelivreur',150)->nullable();
            $table->string('pays',100)->default('maroc');
            $table->string('ville')->nullable();
            $table->string('type')->nullable();
            $table->string('logoOrganisme')->nullable();
            $table->string('diplomeJoint')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diplomes');
    }
};
