<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/{timestamp}_create_sous_unites_table.php
public function up()
{
    Schema::create('sous_unites', function (Blueprint $table) {
        $table->id();
        $table->string('code');
        $table->string('nom');
        $table->unsignedBigInteger('unite_id');
        $table->foreign('unite_id')->references('id')->on('unites');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('sous_unites');
}

};
