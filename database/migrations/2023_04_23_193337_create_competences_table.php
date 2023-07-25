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
        Schema::create('competences', function (Blueprint $table) {
            $table->id('idC');
            $table->string('titre',100);
            $table->integer('level',false,true);
           
            $table->foreignId('profil')
            ->constrained()
            ->on('profils')
            ->references('id')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competences');
    }
};
