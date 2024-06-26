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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chambre_id');
            $table->foreign('chambre_id')->references('id')->on('chambres');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nom_client');
            $table->string('prenoms_client');
            $table->string('email_client');
            $table->string('telephone_client');
            $table->string('statut')->default('Impayé');
            $table->float('prix_par_nuit');
            $table->date('debut_sejour');
            $table->date('fin_sejour');
            $table->date('date_reservation');
            $table->boolean('retire')->default(0);
            $table->boolean('confirme')->default(0);
            $table->boolean('termine')->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
