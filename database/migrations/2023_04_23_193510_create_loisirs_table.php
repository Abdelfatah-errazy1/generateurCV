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
        Schema::create('loisirs', function (Blueprint $table) {
            $table->id('idL');
            $table->string('titre',100);
           
            $table->foreignId('profil')
            ->constrained()
            ->on('profils')
            ->references('id')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('loisirs');
    }
};
