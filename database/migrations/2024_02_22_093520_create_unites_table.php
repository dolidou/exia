<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // database/migrations/{timestamp}_create_unites_table.php
public function up()
{
    Schema::create('unites', function (Blueprint $table) {
        $table->id();
        $table->string('code');
        $table->string('nom');
        $table->integer('semestre');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('unites');
}

};
