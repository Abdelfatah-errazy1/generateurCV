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
        Schema::create('techniques', function (Blueprint $table) {
            $table->id('idTech');
            $table->string('titre',150);
            $table->string('logoTech',255)->nullable();           
            $table->text('description')->nullable();
            $table->foreignId('experience')
            ->constrained()
            ->on('experiences')
            ->references('idE')
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
        Schema::dropIfExists('techniques');
    }
};
