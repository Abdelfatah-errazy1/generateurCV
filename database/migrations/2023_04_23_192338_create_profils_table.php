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
        Schema::create('profils', function (Blueprint $table) {

            $table->id();
            $table->string('cin',10);
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('civilite',50)->nullable();
            $table->string('genre',2)->nullable();
            $table->date('dateNaissance')->nullable();
            $table->string('titre',150)->nullable();
            $table->text('sousTitre')->nullable();
            $table->string('avatar')->nullable();
            $table->text('observation')->nullable();
            $table->string('gsm1',15)->nullable();
            $table->string('gsm2',15)->nullable();
            $table->string('email',100)->nullable();
            $table->string('facebook',100)->nullable();
            $table->string('instagram',100)->nullable();
            $table->string('linkden',100)->nullable();
            $table->string('siteWeb',150)->nullable();
            $table->text('adresse')->nullable();
            $table->string('pays',100)->default('maroc');
            $table->string('ville',100)->nullable();
            $table->string('etat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profils');
    }
};
