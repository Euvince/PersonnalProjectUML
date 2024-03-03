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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->float('montant');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nom_client');
            $table->string('prenoms_client');
            $table->string('email_client');
            $table->string('telephone_client');
            $table->date('date_paiement');
            $table->string('moyen_paiement')->default('STRIPE')/* ->nullable() */;
            $table->unsignedBigInteger('moyen_paiement_id')->nullable();
            $table->foreign('moyen_paiement_id')->references('id')->on('moyens_paiements');
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
        Schema::dropIfExists('paiements');
    }
};
