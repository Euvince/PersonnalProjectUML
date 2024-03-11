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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('type_service_id');
            $table->foreign('type_service_id')->references('id')->on('types_services');
            $table->unsignedBigInteger('chambre_id')->nullable();
            $table->foreign('chambre_id')->references('id')->on('chambres');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nom_client');
            $table->string('prenoms_client');
            $table->string('email_client');
            $table->string('telephone_client');
            $table->date('date_demande_service');
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
        Schema::dropIfExists('services');
    }
};
