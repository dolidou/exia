<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/{timestamp}_create_notes_table.php
public function up()
{
    Schema::create('notes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('sous_unite_id');
        $table->foreign('sous_unite_id')->references('id')->on('sous_unites');
        $table->unsignedBigInteger('etudiant_id');
        $table->foreign('etudiant_id')->references('id')->on('etudiants');
        $table->decimal('note_initiale', 5, 2);
        $table->decimal('note_rattrapage', 5, 2)->nullable();
        $table->decimal('moyenne_initiale', 5, 2);
        $table->decimal('moyenne_rattrapage', 5, 2)->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('notes');
}

};
