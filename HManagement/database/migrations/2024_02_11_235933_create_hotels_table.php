<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->float('longitude');
            $table->float('lattitude');
            $table->float('adresse_postale');
            $table->float('email');
            $table->float('telephone');
            $table->float('directeur');
            $table->unsignedBigInteger('quartier_id');
            $table->foreign('quartier_id')->references('id')->on('quartiers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
