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
        Schema::create('profillangues', function (Blueprint $table) {
            $table->id('idP');
            $table->string('niveau',100);
           
            $table->foreignId('langue')
            ->constrained()
            ->on('langues')
            ->references('idL')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('profil')
            ->constrained()
            ->on('profils')
            ->references('id')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profillangues');
    }
};
